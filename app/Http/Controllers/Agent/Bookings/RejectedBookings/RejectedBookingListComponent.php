<?php

namespace App\Http\Controllers\Agent\Bookings\RejectedBookings;

use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;


class RejectedBookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $rejected_bookings, $booking_modal_data = null;

    public function getRejectedBookings()
    {
        $this->rejected_bookings = Booking::query()->rejected()
            ->with('agency', 'servicetype', 'payment')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->get();

        return Booking::query()->rejected()
            ->with('agency', 'servicetype', 'city')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function getBookingContent(Booking $booking)
    {
        $this->booking_modal_data = $booking;
        $booking = Booking::where('booking_id', $booking->booking_id)->first();
        //  $this->tot_cost = $booking->tot_cost;   
    }

    public function exportToExcel()
    {
        $serialNumber = 1;
        $resultArray = $this->rejected_bookings->map(function ($rej_bookings) use (&$serialNumber) {
            $tot_payments = 0;
            foreach ($rej_bookings->payment as $payment) {

                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $serialNumber++,
                'Booking ID'            => $rej_bookings->booking_id,
                'Name'                  => $rej_bookings->mehram_name,
                'Pax'      => $rej_bookings->adult + $rej_bookings->child_bed + $rej_bookings->child + $rej_bookings->infant,
                // 'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $rej_bookings->travel_date == '1970-01-01' || $rej_bookings->travel_date == '' || $rej_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($rej_bookings->travel_date)),
                'Total Cost'            => $rej_bookings->tot_cost ?? '-',
                'Balance'               => $rej_bookings->tot_cost - $tot_payments,
                'Status'        => $rej_bookings->booking_status == 0 ? 'Pending' : ($rej_bookings->booking_status == 1 ? 'Approved' : ($rej_bookings->booking_status == 2 ? 'Rejected' : ($rej_bookings->booking_status == 3 ? 'Cancelled' : ($rej_bookings->booking_status == 4 ? 'Suspended' : ($rej_bookings->booking_status == 5 ? 'UnderReview' : ($rej_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Rejected Bookings.xlsx');
    }


    public function downloadBooking()
    {
        ini_set('max_execution_time', '360');
        // $booking = Booking::get();
        $booking = Booking::query()->rejected()
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
        return view('agent.bookings.rejected-bookings.rejected-booking-list-component', [
            'rejectedbookings' => $this->getRejectedBookings()
        ]);
    }
}
