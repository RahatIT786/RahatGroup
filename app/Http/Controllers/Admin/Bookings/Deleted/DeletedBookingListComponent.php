<?php

namespace App\Http\Controllers\Admin\Bookings\Deleted;

use App\Helpers\Helper;
use App\Models\Booking;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class DeletedBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $deleted_bookings, $bookingId = null, $booking_id, $booking_modal_data = null, $payments_modal_data = null;

    public function getDeletedBooking()
    {   
        $this->deleted_bookings =  Booking::query()->deleted()
            ->searchAgent($this->search_name)
            ->with('agency') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->desc()
            ->take(800)
            ->get();

        return Booking::query()->deleted()
            ->searchAgent($this->search_name)
            ->with('agency') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function getBookingContent(Booking $booking)
    {
        $booking->load('agency', 'servicetype', 'pnr');
        $this->booking_modal_data = $booking;
    }

    public function isDelete(Booking $booking)
    {
        $this->bookingId = $booking->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bookingData = Booking::whereId($this->bookingId);
        $bookingData->delete();
        $this->alert('success', Lang::get('messages.deleted_booking'));
    }

    public function exportToExcel()
    {   
        $resultArray = $this->deleted_bookings->map(function($del_bookings){
            $tot_payments = 0;
            foreach($del_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $del_bookings->id,
                'Booking ID'            => $del_bookings->booking_id,
                'Name'                  => $del_bookings-> mehram_name,
                'Total Passengers'      => $del_bookings->adult + $del_bookings->child_bed + $del_bookings->child + $del_bookings->infant,
                'Agency Name'           => $del_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $del_bookings->travel_date == '1970-01-01' || $del_bookings->travel_date == '' || $del_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($del_bookings->travel_date)),
                'Total Cost'            => $del_bookings->tot_cost ?? '-',
                'Balance'               => $del_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $del_bookings->booking_status == 0 ? 'Pending' : 
                            ($del_bookings->booking_status == 1 ? 'Approved' : 
                            ($del_bookings->booking_status == 2 ? 'Rejected' : 
                            ($del_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($del_bookings->booking_status == 4 ? 'Suspended' : 
                            ($del_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($del_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Bookings.xlsx');
    }

    public function render()
    {
        return view('admin.bookings.deleted.deleted-booking-list-component', [
            'DeletedBooking' => $this->getDeletedBooking()
        ]);
    }
}
