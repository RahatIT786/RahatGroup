<?php

namespace App\Http\Controllers\Agent\Downloads\Vouchers;

use App\Models\Agent;
use App\Models\Agent\Content;
use App\Models\Booking;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class VouchersListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $currentSegment, $booking_id, $search_name, $perPage = 10;
    public function getVoucher()
    {
        //  dd(auth()->user('agents')->id);
        $records = Booking::query()->approved(a)
            ->where('agency_id', auth()->user()->id)
            ->whereIn('service_type', [1, 2, 20, 21])
            ->with('agency', 'servicetype') // Load the agent relationship
            ->searchLike('booking_id', $this->booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->paymentAmountSum()
            ->get();
        // dd($records);
        $filteredRecords = $records->filter(function ($compare) {
            return $compare->tot_cost <= $compare->payment_sum_amount + $compare->full_payment_discount;
        });
        // dd($filteredRecords);

        $page = request()->get('page', 1); // Get the current page number from the request
        $paginatedRecords = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredRecords->forPage($page, $this->perPage),
            $filteredRecords->count(),
            $this->perPage,
            $page,
            ['path' => request()->url()]
        );

        return $paginatedRecords;
    }

    public function downloadVoucher($vouchersId)
    {
        // Retrieve booking data with package and related hotels
        $voucherData = Booking::with(['agency', 'package.pkgDetails.makkahotel', 'package.pkgDetails.madinahotel', 'pnr'])
            ->where('id', $vouchersId)
            ->first();
        // dd($voucherData);
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
        // dd($data);
        // Generate and return the PDF
        $pdf = Pdf::loadView('agent.downloads.vouchers.voucher-report-pdf-component', $data);
        $docName = "Voucher_Report_" . time() . ".pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline; filename="' . $docName . '"']);
    }


    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.vouchers.vouchers-list-component', [
            'Vouchers' => $this->getVoucher()
        ]);
    }
}
