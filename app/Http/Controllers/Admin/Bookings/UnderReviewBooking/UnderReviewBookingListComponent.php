<?php

namespace App\Http\Controllers\Admin\Bookings\UnderReviewBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UnderReviewBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $under_review_bookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null;

    public function getUnderReviewBooking()
    {   
        $this->under_review_bookings = Booking::query()->underreview()
        ->withTrashed()
        ->with('agency','servicetype') // Load the agent relationship
        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('mehram_name', $this->search_name)
        ->desc()
        ->take(800)
        ->get();
        return Booking::query()->underreview()
            ->withTrashed()
            ->with('agency','servicetype') // Load the agent relationship
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
        $resultArray = $this->under_review_bookings->map(function($under_review_bookings, $index){
            $tot_payments = 0;
            foreach($under_review_bookings->payment as $payment){
                $tot_payments += $payment->amount;
                
            }

            return  [
                'Serial No.'            => $index + 1,
                'Booking ID'            => $under_review_bookings->booking_id,
                'Name'                  => $under_review_bookings-> mehram_name,
                'Total Passengers'      => $under_review_bookings->adult + $under_review_bookings->child_bed + $under_review_bookings->child + $under_review_bookings->infant,
                'Agency Name'           => $under_review_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $under_review_bookings->travel_date == '1970-01-01' || $under_review_bookings->travel_date == '' || $under_review_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($under_review_bookings->travel_date)),
                'Total Cost'            => $under_review_bookings->tot_cost ?? '-',
                'Balance'               => $under_review_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $under_review_bookings->booking_status == 0 ? 'Pending' : 
                            ($under_review_bookings->booking_status == 1 ? 'Approved' : 
                            ($under_review_bookings->booking_status == 2 ? 'Rejected' : 
                            ($under_review_bookings->booking_status == 3 ? 'Cancelled' : 
                            ($under_review_bookings->booking_status == 4 ? 'Suspended' : 
                            ($under_review_bookings->booking_status == 5 ? 'UnderReview' : 
                            ($under_review_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        
        return Helper::exportToExcel($resultArray, 'All Under Review Bookings.xlsx');
    }

    public function render()
    {
        return view('admin.bookings.under-review-booking.under-review-booking-list-component', [
            'UnderReviewBooking' => $this->getUnderReviewBooking()
        ]);
    }
}
