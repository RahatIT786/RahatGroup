<?php

namespace App\Http\Controllers\Agent\Bookings\Bookings;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Agent;
use App\Models\HotelMaster;
use App\Models\Payment;
use App\Models\PackageDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Agent\Content;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class BookingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_booking_id, $search_name, $allBookings, $booking_modal_data, $payments_modal_data, $common_parameters, $hotels;


    public function getBookings()
    {
        //  dd(auth()->user('agent')->id);
        $query = Booking::query()
            ->where('agency_id', auth()->user()->id)
            ->paid()
            ->with('packagetype', 'package.pkgDetails', 'pnr', 'pnr.flight')
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name);

        $this->allBookings = $query->get();
        //  dd($this->allBookings);
        // $this->allBookings = $query->whereId(28)->first();
        // dd($this->allBookings);
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
        }


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
            ->where('agency_id', auth()->user('agent')->id)
            ->Approved()
            ->with('payment')
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

    public function downloadVoucher($vouchersId)
    {
        // Retrieve booking data with package and related hotels
        $voucherData = Booking::with(['agency', 'package.pkgDetails.makkahotel', 'package.pkgDetails.madinahotel', 'pnr'])
            ->where('id', $vouchersId)
            ->first();

        if (!$voucherData) {
            return response()->json(['error' => 'not found'], 404);
        }


        // Retrieve the content for page_id = 23
        $pageContent = Content::where('page_id', 23)->first();
        $pageDescription = $pageContent->description ?? 'No description available';
       // dd($voucherData->package_type);
        // Access the first pkgDetails record (assuming you want to retrieve the first)
       // $pkgDetails = $voucherData->package->pkgDetails;
       $pkgDetails = $voucherData->package->pkgDetails
                        ->where('pkg_type_id', $voucherData->package_type)
                        ->first();

        // dd($pkgDetails);
        if ($pkgDetails) {
            // Makkah and Madinah hotel details
            $makkaHotel = $pkgDetails->makkahotel->hotel_name ?? '';
            $madinaHotel = $pkgDetails->madinahotel->hotel_name ?? '';
            $makkaDistance = $pkgDetails->makkahotel->distance ?? '';
            $madinaDistance = $pkgDetails->madinahotel->distance ?? '';

        } else {
            // Set default values if pkgDetails is empty
            $makkaHotel = '';
            $madinaHotel = '';
            $makkaDistance = '';
            $madinaDistance = '';
        }
        // The PNR data
        $groupName = $voucherData->pnr->group_name ?? '';
        $pnrCode = $voucherData->pnr->pnr_code ?? '';
        $departure_cityname = $voucherData->pnr->city->city_name ?? '';
        $airlines = $voucherData->pnr->flight->flight_name ?? '';
        $dept_date = $voucherData->pnr->dept_date ?? '';
        $dept_time = $voucherData->pnr->dept_time ?? '';
        $return_date = $voucherData->pnr->return_date ?? '';
        $return_time = $voucherData->pnr->return_time ?? '';
        $itenary = $voucherData->pnr->itenary ?? '';
        $tour_leader = $voucherData->pnr->tour_leader ?? '';

        // Access package includes and convert to array
        $packageIncludes = $pkgDetails->package_includes ? explode(',', $pkgDetails->package_includes) : [];

        // Prepare package include details
        $services = [
            'Ticket' => in_array('Ticket', $packageIncludes) ? 'Yes' : 'No',
            'Visa' => in_array('Visa', $packageIncludes) ? 'Yes' : 'No',
            'Stay' => in_array('Stay', $packageIncludes) ? 'No' : 'Yes',
            'Food' => in_array('Meals', $packageIncludes) ? 'Yes' : 'No',
            'Laundry' => in_array('Laundry', $packageIncludes) ? 'No' : 'Yes',
            'Zamzam' => in_array('Zamzam', $packageIncludes) ? 'Yes' : 'No',
            'Transfers' => in_array('Transfers', $packageIncludes) ? 'Yes' : 'No',
            'Ziyarat' => in_array('Ziyarat', $packageIncludes) ? 'Yes' : 'No',
            'Welcome Kit' => in_array('Welcome Kit', $packageIncludes) ? 'Yes' : 'No',
        ];
        // Generate QR Code
        $qrcode = QrCode::format('svg')->size(150)->generate(route('agentDownloadVoucher', $vouchersId));
        $qrcodeBase64 = base64_encode($qrcode);
        $showFlightInfo = ($voucherData->service_type == 2 && $voucherData->package->umrah_type == 1);

        // Prepare data for the PDF view
        $data = [
            'showFlightInfo' => $showFlightInfo,
            // 'service_b => $voucherData->service_typeb ?? '',

            'agency' => $voucherData->agency->agency_name ?? '',
            'agency_mail' => $voucherData->agency->email ?? '',
            'agency_website' => $voucherData->agency->website ?? '',
            'agency_tel' => $voucherData->agency->mobile ?? '',
            'agency_city' => $voucherData->agency->city ?? '',
            'booking_id' => $voucherData->booking_id ?? '',
            'meheram_name' => $voucherData->mehram_name ?? '',

            'package_name' => $voucherData->package->name ?? '',
            'group_name' => $groupName,
            'flight_pnr' => $pnrCode,
            'departure_cityname' => $departure_cityname,
            'airlines' => $airlines,
            'dept_date' => $dept_date,
            'dept_time' => $dept_time,
            'return_date' => $return_date,
            'return_time' => $return_time,
            'itenary' => $itenary,
            'tour_leader' => $tour_leader,

            'no_of_person' => $voucherData->adult + $voucherData->child + $voucherData->child_bed + $voucherData->infant ?? '',
            'adult' => $voucherData->adult ?? '',
            'children' => $voucherData->child  ?? '',
            'childbed' =>  $voucherData->child_bed ?? '',
            'infant' => $voucherData->infant ?? '',
            'qrcode' => $qrcodeBase64,

            // Hotel details
            'makka_hotel' => $makkaHotel,
            'makka_distance' => $makkaDistance,
            'madina_hotel' => $madinaHotel,
            'madina_distance' => $madinaDistance,

            'services' => $services,

            'service_type' => $voucherData->servicetype->name ?? '',
            'package_type' => $voucherData->packagetype->package_type ?? '',
            'sharingtype' => $voucherData->sharingtype->name ?? '',
            'total_pax' => $voucherData->adult + $voucherData->child_bed + $voucherData->child + $voucherData->infant ?? '',
            'total_bed' => $voucherData->adult + $voucherData->child_bed  ?? '',
            'page_description' => $pageDescription,


            //Package Overview
            'meals' => $voucherData->package->meals ?? '',
            'flight_transport' => $voucherData->package->flight_transport ?? '',
            'visa_taxes' => $voucherData->package->visa_taxes ?? '',

            //Inclusions / Exclusions
            'inclusion' => $voucherData->package->inclusion ?? '',
            'exclusion' => $voucherData->package->exclusion ?? '',

            //Itinerary
            'itinerary' => $voucherData->package->itinerary ?? '',

            //Payment Policy / Important Notes
            'payment_policy' => $voucherData->package->payment_policy ?? '',
            'important_notes' => $voucherData->package->important_notes ?? '',

            //Cancellation Policy
            'cancellation_policy' => $voucherData->package->cancellation_policy ?? '',
        ];
        // Generate and return the PDF
        $pdf = Pdf::loadView('agent.downloads.vouchers.voucher-report-pdf-component', $data);
        $docName = "Voucher_Report_" . time() . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }



    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.bookings.bookings.booking-list-component', [
            'bookings' => $this->getBookings()
        ]);
    }
}
