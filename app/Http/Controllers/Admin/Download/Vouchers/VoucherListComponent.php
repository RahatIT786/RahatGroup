<?php

namespace App\Http\Controllers\Admin\Download\Vouchers;

use App\Models\Agent\Content;
use App\Models\Booking;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VoucherListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10, $start_date, $end_date;

    // public function getVoucher()
    // {
    //     return Payment::select(
    //         'aihut_payments.*',
    //         'aihut_booking.booking_id as bookingId',
    //         'aihut_booking.user_type',
    //         'aihut_booking.tot_cost',
    //         'aihut_booking.mehram_name',
    //         'aihut_booking.service_type as booking_service_type',
    //         'aihut_booking.checkin_date',
    //         'aihut_booking.visa_date',
    //         'aihut_booking.travel_date',
    //         'aihut_booking.agency_id',
    //         'aihut_booking.created_at',
    //         'aihut_agent.id as aihut_agent_id',
    //         'aihut_agent.agency_name',
    //         'aihut_service_type.name',
    //         'aihut_booking.adult',
    //         'aihut_booking.child',
    //         'aihut_booking.child_bed',
    //         'aihut_booking.infant',
    //     )
    //         ->join('aihut_booking', 'aihut_payments.booking_id', '=', 'aihut_booking.id')
    //         ->join('aihut_agent', 'aihut_booking.agency_id', '=', 'aihut_agent.id')
    //         ->join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
    //         ->where('aihut_booking.booking_id', '!=', null)
    //         ->when($this->search_booking_id, function ($query) {
    //             return $query->where('aihut_booking.booking_id', 'like', '%' . $this->search_booking_id . '%');
    //         })
    //         ->when($this->search_name, function ($query) {
    //             return $query->where('aihut_booking.mehram_name', 'like', '%' . $this->search_name . '%');
    //         })
    //         ->when($this->start_date && $this->end_date, function ($query) {
    //             return $query->whereBetween('aihut_booking.created_at', [$this->start_date, $this->end_date]);
    //         })

    //         ->orderBy('id', 'desc')
    //         ->paginate($this->perPage);
    // }

    public function getVoucher()
    {
        $records = Booking::select(
            'aihut_booking.id',
            'aihut_booking.booking_id as bookingId',
            'aihut_booking.user_type',
            'aihut_booking.tot_cost',
            'aihut_booking.mehram_name',
            'aihut_booking.service_type as booking_service_type',
            'aihut_booking.checkin_date',
            'aihut_booking.visa_date',
            'aihut_booking.travel_date',
            'aihut_booking.agency_id',
            'aihut_booking.created_at',
            'aihut_agent.id as aihut_agent_id',
            'aihut_agent.agency_name',
            'aihut_service_type.name',
            'aihut_booking.adult',
            'aihut_booking.child',
            'aihut_booking.child_bed',
            'aihut_booking.infant',
            'aihut_booking.full_payment_discount'
        )
            ->join('aihut_agent', 'aihut_booking.agency_id', '=', 'aihut_agent.id')
            ->join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
            ->whereIn('service_type', [1, 2, 20, 21])
            ->paymentAmountSum() // Apply the scope to include `payment_sum_amount`
            ->when($this->search_booking_id, function ($query) {
                return $query->where('aihut_booking.booking_id', 'like', '%' . $this->search_booking_id . '%');
            })
            ->when($this->search_name, function ($query) {
                return $query->where('aihut_booking.mehram_name', 'like', '%' . $this->search_name . '%');
            })
            ->when($this->start_date && $this->end_date, function ($query) {
                return $query->whereBetween('aihut_booking.created_at', [$this->start_date, $this->end_date]);
            })
            ->orderBy('aihut_booking.id', 'desc')
            ->get(); // Get all records first

        // **Filter Records Based on Payment Condition**
        $filteredRecords = $records->filter(function ($record) {
            return isset($record->tot_cost, $record->payment_sum_amount, $record->full_payment_discount) &&
                $record->tot_cost <= ($record->payment_sum_amount + $record->full_payment_discount);
        });

        // **Manual Pagination**
        $page = request()->get('page', 1);
        $paginatedRecords = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredRecords->forPage($page, $this->perPage),
            $filteredRecords->count(),
            $this->perPage,
            $page,
            ['path' => request()->url()]
        );

        return $paginatedRecords;
    }




    public function filterBookings()
    {
        $this->resetPage();
    }

    // public function downloadVoucher($vouchersId)
    // {
    //     // dd($vouchersId);
    //     // Retrieve exam data
    //     $voucherData = Booking::where('id', $vouchersId)->first();
    //     if (!$voucherData) {
    //         return response()->json(['error' => 'not found'], 404);
    //     }
    //     // $qrcode = QrCode::size(150)->generate(route('admin.downloadVoucher', $vouchersId));
    //     $qrcode = QrCode::format('svg')->size(150)->generate(route('downloadVoucher', $vouchersId));
    //     $qrcodeBase64 = base64_encode($qrcode);

    //     // dd($qrcode);
    //     // Prepare data for the PDF view
    //     $data = [
    //         'agency' => $voucherData->agency->agency_name ?? '',
    //         'agency_mail' => $voucherData->agency->email ?? '',
    //         'agency_website' => $voucherData->agency->website ?? '',
    //         'agency_tel' => $voucherData->agency->mobile ?? '',
    //         'agency_city' => $voucherData->agency->city ?? '',
    //         'booking_id' => $voucherData->booking_id ?? '',
    //         'meheram_name' => $voucherData->mehram_name ?? '',

    //         'package_name' => $voucherData->package->name ?? '',
    //         'group_name' => $voucherData->pnr->group_name ?? '',

    //         // 'visa_type' => $voucherData->visatype->visa_name ?? '',
    //         // 'country' => $voucherData->country->countryname ?? '',

    //         'no_of_person' => $voucherData->adult + $voucherData->child + $voucherData->child_bed + $voucherData->infant ?? '',
    //         'adult' => $voucherData->adult ?? '',
    //         'children' => $voucherData->child + $voucherData->child_bed ?? '',
    //         'infant' => $voucherData->infant ?? '',
    //         'visa_date' => $voucherData->visa_date ?? '',
    //         'payable_amount' => $voucherData->tot_cost ?? '',
    //         'qrcode' => $qrcodeBase64,
    //     ];
    //     // dd($data);
    //     // return view('admin.download.vouchers.voucher-report-pdf-component', $data);
    //     $pdf = Pdf::loadView('admin.download.vouchers.voucher-report-pdf-component', $data);
    //     $docName = "Voucher_Report_" . time() . ".pdf";
    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf->stream();
    //     }, $docName);
    // }

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

        // Filter pkgDetails and get the first match
        $pkgDetails = $voucherData->package->pkgDetails->filter(function ($detail) use ($voucherData) {
            return $detail->pkg_type_id == $voucherData->package_type;
        })->first(); // Get the first matching record

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
        $qrcode = QrCode::format('svg')->size(150)->generate(route('downloadVoucher', $vouchersId));
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
        // dd($data);
        // Generate and return the PDF
        $pdf = Pdf::loadView('admin.download.vouchers.voucher-report-pdf-component', $data);
        $docName = "Voucher_Report_" . time() . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="' . $docName . '"']);
    }

    public function render()
    {
        // dd($this->getVoucher());
        return view('admin.download.vouchers.voucher-list-component', [
            'Vouchers' => $this->getVoucher()
        ]);
    }
}
