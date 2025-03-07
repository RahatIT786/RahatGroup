<?php

namespace App\Http\Controllers\Agent\Bookings\SuspendedBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class SuspendedBookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $suspended_bookings, $booking_modal_data = null;

    public function getSuspendedBookings()
    {
        $this->suspended_bookings = Booking::query()->suspended()
            ->with('agency', 'servicetype', 'payment')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->get();

        return Booking::query()->suspended()
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
        $resultArray = $this->suspended_bookings->map(function ($suspend_bookings) use (&$serialNumber) {
            $tot_payments = 0;
            foreach ($suspend_bookings->payment as $payment) {

                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $serialNumber++,
                'Booking ID'            => $suspend_bookings->booking_id,
                'Name'                  => $suspend_bookings->mehram_name,
                'Pax'      => $suspend_bookings->adult + $suspend_bookings->child_bed + $suspend_bookings->child + $suspend_bookings->infant,
                // 'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $suspend_bookings->travel_date == '1970-01-01' || $suspend_bookings->travel_date == '' || $suspend_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($suspend_bookings->travel_date)),
                'Total Cost'            => $suspend_bookings->tot_cost ?? '-',
                'Balance'               => $suspend_bookings->tot_cost - $tot_payments,
                'Status'        => $suspend_bookings->booking_status == 0 ? 'Pending' : ($suspend_bookings->booking_status == 1 ? 'Approved' : ($suspend_bookings->booking_status == 2 ? 'Rejected' : ($suspend_bookings->booking_status == 3 ? 'Cancelled' : ($suspend_bookings->booking_status == 4 ? 'Suspended' : ($suspend_bookings->booking_status == 5 ? 'UnderReview' : ($suspend_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Suspended Bookings.xlsx');
    }


    public function downloadBooking()
    {
        ini_set('max_execution_time', '360');
        // $booking = $this->suspended_bookings = Booking::suspended()->get();
        $booking = Booking::query()->suspended()
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
        return view('agent.bookings.suspended-bookings.suspended-booking-list-component', [
            'suspendedbookings' => $this->getSuspendedBookings()
        ]);
    }
}
