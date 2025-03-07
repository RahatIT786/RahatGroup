<?php

namespace App\Http\Controllers\Agent\Bookings\PendingBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class PendingBookingListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $pending_bookings, $booking_modal_data = null;

    public function getPendingBookings()
    {
        $query= Booking::query()->pending()
        ->with('agency', 'servicetype', 'city', 'payment')
        ->where('agency_id', auth()->user()->id)
        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('mehram_name', $this->search_name)
        ->desc();

        $this->pending_bookings = $query->get();

        return $query->paginate($this->perPage);
    }

    public function getBookingContent(Booking $booking)
    {
        $this->booking_modal_data = $booking;
        $booking = Booking::where('booking_id', $booking->booking_id)->first();
        //  $this->tot_cost = $booking->tot_cost;   
    }

    public function exportToExcel()
    {
        $resultArray = $this->pending_bookings->map(function ($pending_bookings) {
            $tot_payments = 0;
            foreach ($pending_bookings->payment as $payment) {
                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $pending_bookings->id,
                'Booking ID'            => $pending_bookings->booking_id,
                'Name'                  => $pending_bookings->mehram_name,
                'Total Passengers'      => $pending_bookings->adult + $pending_bookings->child_bed + $pending_bookings->child + $pending_bookings->infant,
                'Agency Name'           => $pending_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $pending_bookings->travel_date == '1970-01-01' || $pending_bookings->travel_date == '' || $pending_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($pending_bookings->travel_date)),
                'Total Cost'            => $pending_bookings->tot_cost ?? '-',
                'Balance'               => $pending_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $pending_bookings->booking_status == 0 ? 'Pending' : ($pending_bookings->booking_status == 1 ? 'Approved' : ($pending_bookings->booking_status == 2 ? 'Rejected' : ($pending_bookings->booking_status == 3 ? 'Cancelled' : ($pending_bookings->booking_status == 4 ? 'Suspended' : ($pending_bookings->booking_status == 5 ? 'UnderReview' : ($pending_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Bookings.xlsx');
    }

    public function downloadPending()
    {
        ini_set('max_execution_time', '360');
        // $booking = Booking::get();
        $booking = Booking::query()
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
        return view('agent.bookings.pending-bookings.pending-booking-list-component', [
            'pendingbookings' => $this->getPendingBookings()
        ]);
    }
}
