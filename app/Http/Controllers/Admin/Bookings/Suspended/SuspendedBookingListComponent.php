<?php

namespace App\Http\Controllers\Admin\Bookings\Suspended;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SuspendedBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $suspended_bookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null;
    public function getSuspendedBooking()
    {
        $query= Booking::query()->suspended()->with('agency', 'servicetype','payment')
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
        $resultArray = $this->suspended_bookings->map(function($sus_bookings, $index){
            $tot_payments = 0;
            foreach($sus_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $index + 1,
                'Booking ID'            => $sus_bookings->booking_id,
                'Name'                  => $sus_bookings-> mehram_name,
                'Total Passengers'      => $sus_bookings->adult + $sus_bookings->child_bed + $sus_bookings->child + $sus_bookings->infant,
                'Agency Name'           => $sus_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $sus_bookings->travel_date == '1970-01-01' || $sus_bookings->travel_date == '' || $sus_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($sus_bookings->travel_date)),
                'Total Cost'            => $sus_bookings->tot_cost ?? '-',
                'Balance'               => $sus_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $sus_bookings->booking_status == 0 ? 'Pending' : 
                            ($sus_bookings->booking_status == 1 ? 'Approved' : 
                            ($sus_bookings->booking_status == 2 ? 'Rejected' : 
                            ($sus_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($sus_bookings->booking_status == 4 ? 'Suspended' : 
                            ($sus_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($sus_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Suspended Bookings.xlsx');
    }
    public function render()
    {
        return view('admin.bookings.suspended.suspended-booking-list-component', [
            'Suspended' => $this->getSuspendedBooking()
        ]);
    }
}
