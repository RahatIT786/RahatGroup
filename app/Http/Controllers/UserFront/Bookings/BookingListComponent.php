<?php

namespace App\Http\Controllers\UserFront\Bookings;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\HotelMaster;
use App\Models\Payment;
use App\Models\PackageDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name, $allBookings, $booking_modal_data, $payments_modal_data, $common_parameters, $hotels;


    public function getBookings()
    {
        //  dd(auth()->user('agent')->id);
        $query = Booking::query()
            ->where('user_type', auth()->user()->id)
            ->paid()
            ->with('packagetype', 'package.pkgDetails', 'pnr', 'pnr.flight')
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name);

        $this->allBookings = $query->get();
        return $query->desc()->paginate($this->perPage);
    }

    public function filterBookings()
    {
        $this->resetPage();
    }

    public function getBookingContent(Booking $booking)
    {
        $booking->load('agency', 'servicetype', 'pnr', 'city', 'packagetype', 'sharingtype');
        $this->booking_modal_data = $booking;

        if ($this->booking_modal_data->service_type == 2) {


            $hotel_ids = PackageDetails::where('pkg_id', $this->booking_modal_data->package_name)->where('pkg_type_id', $this->booking_modal_data->package_type)->first();

            $this->hotels = HotelMaster::where('id', $hotel_ids->makka_hotel_id)->orwhere('id', $hotel_ids->madina_hotel_id)->with('hotelimage', 'city')->get();
            // dd($this->hotels);

        }

        //  dd($this->booking_modal_data);
    }

    public function getPaymentContent($bookingId)
    {

        $this->payments_modal_data = Payment::where('booking_id', $bookingId)->with('booking')->get();

        // dd($this->payments_modal_data[0]->booking);
    }

    public function exportToExcel()
    {
        $resultArray = $this->allBookings->map(function ($all_bookings) {
            $tot_payments = 0;
            foreach ($all_bookings->payment as $payment) {
                $tot_payments += $payment->amount + $all_bookings->full_payment_discount;
            }
            return  [
                'Serial No.'            => $all_bookings->id,
                'Booking ID'            => $all_bookings->booking_id,
                'Name'                  => $all_bookings->mehram_name,
                'Pax'                   => $all_bookings->adult + $all_bookings->child_bed + $all_bookings->child + $all_bookings->infant,
                'Travel Date'           => $all_bookings->travel_date == '1970-01-01' || $all_bookings->travel_date == '' || $all_bookings->travel_date == null ? 'N/A' : date('d-M-Y', strtotime($all_bookings->travel_date)),
                'Total Cost'            => $all_bookings->tot_cost ?? '-',
                'Balance'               => $all_bookings->tot_cost - $tot_payments,
                'Booking Status'        => $all_bookings->booking_status == 0 ? 'Pending' : ($all_bookings->booking_status == 1 ? 'Approved' : ($all_bookings->booking_status == 2 ? 'Rejected' : ($all_bookings->booking_status == 3 ? 'Cancelled' : ($all_bookings->booking_status == 4 ? 'Suspended' : ($all_bookings->booking_status == 5 ? 'UnderReview' : ($all_bookings->booking_status == 6 ? 'Deleted' : 'Waiting List'))))))
            ];
        })->toArray();
        return Helper::exportToExcel($resultArray, 'All Bookings.xlsx');
    }

    public function downloadBooking()
    {
        ini_set('max_execution_time', '360');
        // $booking = Booking::get();
        $booking = Booking::query()
            ->where('user_type', auth()->user('customer')->id)
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
    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.bookings.booking-list-component', [
            'bookings' => $this->getBookings()
        ]);
    }
}
