<?php

namespace App\Http\Controllers\Agent\Bookings\CancelledBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class CancelledBookingListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $cancelled_bookings, $booking_modal_data = null;

    public function getCancelledBookings()
    {
        $this->cancelled_bookings = Booking::query()->cancelled()
            ->with('agency', 'servicetype', 'payment')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->get();

        return Booking::query()->cancelled()
            ->with('agency', 'servicetype', 'city')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function getBookingContent(Booking $booking)
    {
        $booking->load('agency', 'servicetype', 'pnr', 'city');
        $this->booking_modal_data = $booking;
    }

    public function exportToExcel()
    {
        $serialNumber = 1;
        $resultArray = $this->cancelled_bookings->map(function ($cancel_bookings) use (&$serialNumber) {
            $tot_payments = 0;
            foreach ($cancel_bookings->payment as $payment) {

                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $serialNumber++,
                'Booking ID'            => $cancel_bookings->booking_id,
                'Name'                  => $cancel_bookings->mehram_name,
                'Pax'      => $cancel_bookings->adult + $cancel_bookings->child_bed + $cancel_bookings->child + $cancel_bookings->infant,
                // 'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $cancel_bookings->travel_date == '1970-01-01' || $cancel_bookings->travel_date == '' || $cancel_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($cancel_bookings->travel_date)),
                'Total Cost'            => $cancel_bookings->tot_cost ?? '-',
                'Balance'               => $cancel_bookings->tot_cost - $tot_payments,
                'Status'        => $cancel_bookings->booking_status == 0 ? 'Pending' : ($cancel_bookings->booking_status == 1 ? 'Approved' : ($cancel_bookings->booking_status == 2 ? 'Rejected' : ($cancel_bookings->booking_status == 3 ? 'Cancelled' : ($cancel_bookings->booking_status == 4 ? 'Suspended' : ($cancel_bookings->booking_status == 5 ? 'UnderReview' : ($cancel_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Cancelled Bookings.xlsx');
    }

    public function downloadBooking()
    {
        ini_set('max_execution_time', '360');
        // $booking = $this->cancelled_bookings = Booking::cancelled()->get();
        $booking = Booking::query()->cancelled()
            ->where('agency_id', auth()->user('agent')->id)
            ->get();

        // dd($booking);
        if (!$booking) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'bookingData' => $booking,
        ];
        $pdf = Pdf::loadView('agent.bookings.all_bookings_pdf', $data);
        $docName = "All_Booking_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }


    public function filterBookings()
    {
        $this->resetPage();
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.bookings.cancelled-bookings.cancelled-booking-list-component', [
            'cancelledbookings' => $this->getCancelledBookings()
        ]);
    }
}
