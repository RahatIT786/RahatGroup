<?php

namespace App\Http\Controllers\Admin\Bookings\WaitingBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class WaitingBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $waiting_bookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null;
    public function getWaitingBooking()
    {   
        $this->waiting_bookings = Booking::query()->waitinglist()
            ->withTrashed()
            ->with('agency') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->take(800)
            ->get();
        return Booking::query()->waitinglist()
            ->withTrashed()
            ->with('agency') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
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
        $resultArray = $this->waiting_bookings->map(function($waiting_bookings, $index){
            $tot_payments = 0;
            foreach($waiting_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $index + 1,
                'Booking ID'            => $waiting_bookings->booking_id,
                'Name'                  => $waiting_bookings-> mehram_name,
                'Total Passengers'      => $waiting_bookings->adult + $waiting_bookings->child_bed + $waiting_bookings->child + $waiting_bookings->infant,
                'Agency Name'           => $waiting_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $waiting_bookings->travel_date == '1970-01-01' || $waiting_bookings->travel_date == '' || $waiting_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($waiting_bookings->travel_date)),
                'Total Cost'            => $waiting_bookings->tot_cost ?? '-',
                'Balance'               => $waiting_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $waiting_bookings->booking_status == 0 ? 'Pending' : 
                            ($waiting_bookings->booking_status == 1 ? 'Approved' : 
                            ($waiting_bookings->booking_status == 2 ? 'Rejected' : 
                            ($waiting_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($waiting_bookings->booking_status == 4 ? 'Suspended' : 
                            ($waiting_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($waiting_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Waiting Listed Bookings.xlsx');
    }

    public function render()
    {
        return view('admin.bookings.waiting-booking.waiting-booking-list-component', [
            'WaitingBooking' => $this->getWaitingBooking()
        ]);
    }
}
