<?php

namespace App\Http\Controllers\Admin\Bookings\RejectBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class RejectBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $rejected_bookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null;

    public function getRejectBooking()
    {
        $query= Booking::query()->rejected()->with('agency', 'servicetype','payment')
        ->withTrashed() // Load the agent relationship
        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('mehram_name', $this->search_mehram_name)
        ->searchAgent($this->search_name)
        ->searchTravelDate($this->search_start_date, $this->search_end_date)
        ->desc();

        $this->allBookings = $query->get();

        return $query ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function getBookingContent(Booking $booking)
    {
        $booking->load('agency', 'servicetype', 'pnr', 'city');
        $this->booking_modal_data = $booking;
    }

    public function deleted()
    {
        $this->alert('success', 'Already Deleted !');
    }

    public function isDelete(Booking $booking)
    {
        $this->booking_id = $booking->id;
        if ($booking->booking_status != 6) {
            $this->confirm('Are you sure to delete this?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmDelete',
            ]);
        } else {

            $this->deleted();
        }
    }

    public function confirmDelete()
    {
        $bookingData = Booking::whereId($this->booking_id);

        if ($bookingData) {
            $bookingData->update(['deleted_at' => now(), 'booking_status' => 6]);
            $this->alert('success', 'Deleted successfully');
        } else {
            $this->alert('error', 'Record not found');
        }
    }

    public function exportToExcel()
    {   
        $resultArray = $this->rejected_bookings->map(function($rej_bookings, $index){
            $tot_payments = 0;
            foreach($rej_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $index + 1,
                'Booking ID'            => $rej_bookings->booking_id,
                'Name'                  => $rej_bookings-> mehram_name,
                'Total Passengers'      => $rej_bookings->adult + $rej_bookings->child_bed + $rej_bookings->child + $rej_bookings->infant,
                'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $rej_bookings->travel_date == '1970-01-01' || $rej_bookings->travel_date == '' || $rej_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($rej_bookings->travel_date)),
                'Total Cost'            => $rej_bookings->tot_cost ?? '-',
                'Balance'               => $rej_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $rej_bookings->booking_status == 0 ? 'Pending' : 
                            ($rej_bookings->booking_status == 1 ? 'Approved' : 
                            ($rej_bookings->booking_status == 2 ? 'Rejected' : 
                            ($rej_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($rej_bookings->booking_status == 4 ? 'Suspended' : 
                            ($rej_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($rej_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Rejected Bookings.xlsx');
    }

    public function download()
    {   
        ini_set('max_execution_time', '3600');
        $data = [
            'Booking_Data' => $this->rejected_bookings
        ];

        $pdf = Pdf::loadView('admin.bookings.all-bookings-pdf', $data);

        $docName = "All Rejected Bookings" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }


    public function render()
    {
        return view('admin.bookings.reject-booking.reject-booking-list-component', [
            'rejectBookings' => $this->getRejectBooking()
        ]);
    }
}
