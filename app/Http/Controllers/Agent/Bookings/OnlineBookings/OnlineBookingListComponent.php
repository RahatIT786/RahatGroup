<?php

namespace App\Http\Controllers\Agent\Bookings\OnlineBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class OnlineBookingListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $online_bookings, $booking_modal_data = null;

    public function getOnlineBookings()
    {
        $this->online_bookings = Booking::query()->underreview()
            ->withTrashed()
            ->with('agency') // Load the agent relationship
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->get();
        return Booking::query()->underreview()
            ->withTrashed()
            ->with('agency') // Load the agent relationship
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
        $resultArray = $this->online_bookings->map(function ($onln_bookings) use (&$serialNumber) {
            $tot_payments = 0;
            foreach ($onln_bookings->payment as $payment) {

                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $serialNumber++,
                'Booking ID'            => $onln_bookings->booking_id,
                'Name'                  => $onln_bookings->mehram_name,
                'Pax'      => $onln_bookings->adult + $onln_bookings->child_bed + $onln_bookings->child + $onln_bookings->infant,
                // 'Agency Name'           => $rej_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $onln_bookings->travel_date == '1970-01-01' || $onln_bookings->travel_date == '' || $onln_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($onln_bookings->travel_date)),
                'Total Cost'            => $onln_bookings->tot_cost ?? '-',
                'Balance'               => $onln_bookings->tot_cost - $tot_payments,
                'Status'        => $onln_bookings->booking_status == 0 ? 'Pending' : ($onln_bookings->booking_status == 1 ? 'Approved' : ($onln_bookings->booking_status == 2 ? 'Rejected' : ($onln_bookings->booking_status == 3 ? 'Cancelled' : ($onln_bookings->booking_status == 4 ? 'Suspended' : ($onln_bookings->booking_status == 5 ? 'UnderReview' : ($onln_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Online Bookings.xlsx');
    }

    public function downloadBooking()
    {
        ini_set('max_execution_time', '360');
        // $booking = $this->online_bookings = Booking::underreview()->get();
        $booking = Booking::query()->underreview()
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
        return view('agent.bookings.online-bookings.online-booking-list-component', [
            'onlinebookings' => $this->getOnlineBookings()
        ]);
    }
}
