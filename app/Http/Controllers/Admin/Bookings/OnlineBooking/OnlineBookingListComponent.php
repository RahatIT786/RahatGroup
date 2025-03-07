<?php

namespace App\Http\Controllers\Admin\Bookings\OnlineBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class OnlineBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $online_bookings,$booking_id, $booking_modal_data = null, $payments_modal_data = null;

    public function getOnlinebooking()
    {   
        $this->online_bookings = Booking::query()->underreview()
            ->withTrashed()
            ->with('agency') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->take(800)
            ->get();
            
        return Booking::query()->underreview()
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
        $resultArray = $this->online_bookings->map(function($online_bookings){
            $tot_payments = 0;
            foreach($online_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $online_bookings->id,
                'Booking ID'            => $online_bookings->booking_id,
                'Name'                  => $online_bookings-> mehram_name,
                'Total Passengers'      => $online_bookings->adult + $online_bookings->child_bed + $online_bookings->child + $online_bookings->infant,
                'Agency Name'           => $online_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $online_bookings->travel_date == '1970-01-01' || $online_bookings->travel_date == '' || $online_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($online_bookings->travel_date)),
                'Total Cost'            => $online_bookings->tot_cost ?? '-',
                'Balance'               => $online_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $online_bookings->booking_status == 0 ? 'Pending' : 
                            ($online_bookings->booking_status == 1 ? 'Approved' : 
                            ($online_bookings->booking_status == 2 ? 'Rejected' : 
                            ($online_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($online_bookings->booking_status == 4 ? 'Suspended' : 
                            ($online_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($online_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Online Bookings.xlsx');
    }
    public function render()
    {
        return view('admin.bookings.online-booking.online-booking-list-component', [
            'OnlineBooking' => $this->getOnlinebooking()
        ]);
    }
}
