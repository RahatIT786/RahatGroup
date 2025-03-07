<?php

namespace App\Http\Controllers\Admin\Bookings\CancelledBooking;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class CancelledBookingListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $canclled_booking, $booking_id, $booking_modal_data = null, $payments_modal_data = null;

    public function getCancelledBooking()
    {

        $query = Booking::query()->cancelled()->with('agency', 'servicetype', 'payment')
            ->withTrashed() // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            // ->searchLike('mehram_name', $this->search_mehram_name)
            ->searchAgent($this->search_name)
            // ->searchTravelDate($this->search_start_date, $this->search_end_date)
            ->desc();

        $this->allBookings = $query->get();

        return $query->paginate($this->perPage);
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
        // Fetch only cancelled bookings
        $this->canclled_booking = Booking::cancelled()->with('agency', 'payment')->get();

        // Transform the data for Excel export
        $resultArray = $this->canclled_booking->map(function ($canclled_booking, $index) {
            $tot_payments = $canclled_booking->payment->sum('amount'); // Calculate total payments

            return [
                'Serial No.'        => $index + 1,
                'Booking ID'        => $canclled_booking->booking_id,
                'Name'              => $canclled_booking->mehram_name,
                'Total Passengers'  => $canclled_booking->adult + $canclled_booking->child_bed + $canclled_booking->child + $canclled_booking->infant,
                'Agency Name'       => $canclled_booking->agency->agency_name ?? '-',
                'Travel Date'       => empty($canclled_booking->travel_date) || $canclled_booking->travel_date == '1970-01-01'
                    ? '-'
                    : date('d-M-Y', strtotime($canclled_booking->travel_date)),
                'Total Cost'        => $canclled_booking->tot_cost ?? '-',
                'Balance'           => $canclled_booking->tot_cost - $tot_payments,
                'Booking Status'    => 'Cancelled', // Since we are fetching only cancelled bookings
            ];
        })->toArray();

        // Export to Excel
        return Helper::exportToExcel($resultArray, 'Cancelled Bookings.xlsx');
    }

    public function download()
    {
        ini_set('max_execution_time', '3600');

        // Ensure cancelled bookings are loaded
        $this->canclled_booking = Booking::cancelled()->with('agency', 'payment')->get();

        if ($this->canclled_booking->isEmpty()) {
            return $this->alert('error', 'No cancelled bookings found to generate PDF.');
        }

        $data = [
            'Booking_Data' => $this->canclled_booking
        ];

        $pdf = Pdf::loadView('admin.bookings.all-bookings-pdf', $data);

        $docName = "All_Cancelled_Bookings_" . time() . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }
    public function render()
    {
        return view('admin.bookings.cancelled-booking.cancelled-booking-list-component', [
            'cancelledBookings' => $this->getCancelledBooking()
        ]);
    }
}
