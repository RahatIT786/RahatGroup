<?php

namespace App\Http\Controllers\Agent\Bookings\ApprovedBookings;

use Livewire\Component;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;

class ApprovedBookingListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name;
    public $approved_bookings, $booking_modal_data = null,$booking;

    public function getApprovedBookings()
    {
        // dd(auth()->user('agents')->id);
        $this->approved_bookings = Booking::query()->approved()
            ->with('agency', 'servicetype', 'payment')
            ->where('agency_id', auth()->user('agents')->id)
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->get();

        return Booking::query()->approved()
            ->with('agency', 'servicetype', 'city', 'payment')
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
        $resultArray = $this->approved_bookings->map(function ($app_bookings) {
            $tot_payments = 0;
            foreach ($app_bookings->payment as $payment) {
                $tot_payments += $payment->amount;
            }

            return  [
                'Serial No.'            => $app_bookings->id,
                'Booking ID'            => $app_bookings->booking_id,
                'Name'                  => $app_bookings->mehram_name,
                'Total Passengers'      => $app_bookings->adult + $app_bookings->child_bed + $app_bookings->child + $app_bookings->infant,
                'Agency Name'           => $app_bookings->agency->agency_name ?? '-',
                'Travel Date'           => $app_bookings->travel_date == '1970-01-01' || $app_bookings->travel_date == '' || $app_bookings->travel_date == null ? '-' : date('d-M-Y', strtotime($app_bookings->travel_date)),
                'Total Cost'            => $app_bookings->tot_cost ?? '-',
                'Balance'               => $app_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $app_bookings->booking_status == 0 ? 'Pending' : ($app_bookings->booking_status == 1 ? 'Approved' : ($app_bookings->booking_status == 2 ? 'Rejected' : ($app_bookings->booking_status == 3 ? 'Cancelled' : ($app_bookings->booking_status == 4 ? 'Suspended' : ($app_bookings->booking_status == 5 ? 'UnderReview' : ($app_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'All Approved Bookings.xlsx');
    }
    public function downloadApproved()
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
        return view('agent.bookings.approved-bookings.approved-booking-list-component', [
            'approvedbookings' => $this->getApprovedBookings()
        ]);
    }
}
