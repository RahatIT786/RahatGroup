<?php

namespace App\Http\Controllers\Admin\Pnr;

use App\Helpers\Helper;
use App\Models\AdminSetting;
use App\Models\Booking;
use App\Models\GuestDetail;
use App\Models\Packages;
use App\Models\Pnr;
use App\Models\Relation;
use App\Models\VoucherContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PnrListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $booking_id, $booking_modal_data = null, $payments_modal_data = null, $flight_name;
    public $showConfirmation = false;
    public $package_name, $package_type, $pnr_code, $search_dept_date;
    public $modalData, $Id, $fireticket, $bookings, $pnr_id, $airlineformat, $roomplan;
    public $package_details,$package_names,$passenger_modaldata;

    public function getPnr()
    {

        $this->roomplan = Booking::with('agency', 'guestdetail', 'pnr', 'city', 'sharingtype')
            ->where('pnr_id', $this->pnr_id)
            ->orderBy('id', 'desc')
            ->get();

        return Pnr::desc()
            ->with('city', 'flight')
            ->searchLike('pnr_code', $this->pnr_code)
            ->searchFlight($this->flight_name)
            ->searchPnrDate($this->search_dept_date)
            ->paginate($this->perPage);
    }

    public function filterPnr()
    {
        $this->resetPage();
    }

    public function getModalContent($pnr)
    {
        $this->modalData = Pnr::whereId($pnr)->first();
        $pack_ids = explode(',',$this->modalData->pack_id);

        $this->package_details = Packages::whereIn('id',$pack_ids)->pluck('name')->toArray();

        $this->package_names = implode(',', $this->package_details);
    }

    public function isDelete(Pnr $pnr)
    {
        $this->Id = $pnr->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bookings = Booking::where('pnr_id', $this->Id)->exists();

        if ($bookings) {
            $this->alert('error', 'This PNR is already booked by some users, deletion is not allowed.');
        } else {
            $packageMasterData = Pnr::whereId($this->Id)->first();

            if ($packageMasterData) {
                $packageMasterData->delete();
                $this->alert('success', 'Record has been deleted successfully');
            }
        }
    }


    public function toggleStatus(Pnr $pnr)
    {
        $this->Id = $pnr->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $packageMasterData = Pnr::whereId($this->Id);
        $packageMasterData->update(['is_active' => !$packageMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.pnr_status_changed'));
    }


    public function isDupicate(Pnr $pnr)
    {
        $this->Id = $pnr->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }

    public function confirmDuplicate()
    {
        try {
            $packageMasterData = Pnr::find($this->Id);
            $copypackageMasterData = [
                'pnr_code' =>  $packageMasterData->pnr_code,
                'pack_id' =>  $packageMasterData->pack_id,
                'group_name' => $packageMasterData->group_name,
                'flight_id' => $packageMasterData->flight_id,
                'dept_city_id' => $packageMasterData->dept_city_id,
                'flight_type' => $packageMasterData->flight_type,
                'departure_sector' => $packageMasterData->departure_sector,
                'return_sector' => $packageMasterData->return_sector,
                'pnr_pack_type' => $packageMasterData->pnr_pack_type,
                'dept_date' => $packageMasterData->dept_date,
                'dept_time' => $packageMasterData->arrival_time,
                'return_date' => $packageMasterData->return_date,
                'return_time' => $packageMasterData->departure_time,
                'days' => $packageMasterData->days,
                'seats' => $packageMasterData->seats,
                'avai_seats' => $packageMasterData->avai_seats,
                'tour_leader' => $packageMasterData->tour_leader,
                'supp_name' => $packageMasterData->supp_name,
                'transco_name' => $packageMasterData->transco_name,
                'mobno_tc' => $packageMasterData->mobno_tc,
                'adult_cost' => $packageMasterData->adult_cost,
                'child_cost' => $packageMasterData->child_cost,
                'infant_cost' => $packageMasterData->infant_cost,
                'itenary' => $packageMasterData->itenary,
                'baggage' => $packageMasterData->baggage,
                'cancel_fee' => $packageMasterData->cancel_fee,
                'transport_brn' => $packageMasterData->transport_brn,
                'is_active' => $packageMasterData->is_active,

            ];

            Pnr::create($copypackageMasterData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new package master: ' . $e->getMessage());
        }
        $this->alert('success', 'Record has been Duplicated successfully');
    }

    public function downloadPnr()
    {
        $pnr = Pnr::get();

        if (!$pnr) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'pnrData' => $pnr,
        ];
        $pdf = Pdf::loadView('admin.pnr.pnr_pdf', $data);
        $docName = "PNR_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }


    public function downloadTransportVoucher($id)
    {
        // Load the PNR with necessary relationships
        $pnr = Pnr::with([
            'flight',
            'departuresector',
            'returnsector',
            'package.pkgDetails.makkahotel',
            'package.pkgDetails.madinahotel'
        ])->where('id', $id)->first();

        if (!$pnr) {
            return response()->json(['error' => 'PNR not found'], 404);
        }

        // Split the pack_id column values by comma to handle multiple package IDs
        $packIds = explode(',', $pnr->pack_id);

        // Initialize arrays for hotel details
        $makkaHotels = [];
        $madinaHotels = [];

        // Iterate through each pack_id and retrieve pkgDetails
        foreach ($packIds as $packId) {
            // Retrieve the package and related pkgDetails for each pack_id
            $package = Packages::with('pkgDetails.makkahotel', 'pkgDetails.madinahotel')->where('id', $packId)->first();

            if ($package && $package->pkgDetails->first()) {
                $pkgDetails = $package->pkgDetails->first();

                // Makkah hotel details
                $makkaHotelName = $pkgDetails->makkahotel->hotel_name ?? 'N/A';
                $makkaHotels[] = $makkaHotelName;

                // Madinah hotel details
                $madinaHotelName = $pkgDetails->madinahotel->hotel_name ?? 'N/A';
                $madinaHotels[] = $madinaHotelName;
            }
        }

        // Concatenate the hotel names with a separator (e.g., ' / ')
        $makkaHotel = implode(' / ', $makkaHotels);
        $madinaHotel = implode(' / ', $madinaHotels);

        // Calculate the MakkaDuration and other date calculations as before
        $makkaDuration = floor(number_format(15 / 2, 2));
        $deptDate = Carbon::parse($pnr->dept_date);
        $makkaCheckOutDate = $deptDate->addDays($makkaDuration);
        $madinaCheckInDate = $deptDate->copy()->addDays($makkaDuration);
        $madinaMazaratDate = $madinaCheckInDate->copy()->addDays(3);

        // Retrieve the booking data
        $bookingData = Booking::where('pnr_id', $id)->first();



        // Get the path to the image
        $bgTopPath = public_path('assets/img/transport_voucher/bg-top-img.jpg');
        $bgcenterPath = public_path('assets/img/transport_voucher/bg-center-img.jpg');


        if (file_exists($bgTopPath)) {
            $type = pathinfo($bgTopPath, PATHINFO_EXTENSION);
            $data = file_get_contents($bgTopPath);
            $leftimageBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }


        if (file_exists($bgcenterPath)) {
            // Get the image type
            $type = pathinfo($bgcenterPath, PATHINFO_EXTENSION);

            // Read the image file
            $data = file_get_contents($bgcenterPath);

            // Convert to Base64
            $base64 = base64_encode($data);

            // Create the Base64 image string
            $headimageBase64 = 'data:image/' . $type . ';base64,' . $base64;

            // You can now use $base64Image in your PDF
        }


        // Prepare data for the PDF view
        $data = [
            'package_image_top' => $bgTopPath,
            'package_center_bottom' => $bgcenterPath,
            'package_image_bottom' => 'assets/img/transport_voucher/bg-bottom-img.jpg',

            'voucher_no' => $pnr->id ?? '',
            'group_no' => $pnr->group_no ?? '',
            'subagent_name' => $pnr->sub_agent_name ?? '',
            'tour_leader' => $pnr->tour_leader ?? '',
            'contact_no' => $pnr->contact_no ?? '',
            'rawda_permit' => $pnr->rawda_permit ?? '',
            'departuresector' => $pnr->departuresector->sector_name ?? '',
            'returnsector' => $pnr->returnsector->sector_name ?? '',
            'departuredate' => $pnr->dept_date ?? '',
            'returndate' => $pnr->return_date ?? '',
            'departuretime' => $pnr->dept_time ?? '',
            'returntime' => $pnr->return_time ?? '',
            'flightcode' => $pnr->flight->flight_code ?? '',
            'carrier' => $pnr->flight->carrier ?? '',

            // Hotel details with concatenated hotel names
            'makka_hotel' => $makkaHotel,
            'madina_hotel' => $madinaHotel,
            'makkaDuration' => $makkaDuration ?? '',
            'makkaCheckOutDate' => $makkaCheckOutDate ?? '',
            'madinaCheckInDate' => $madinaCheckInDate ?? '',
            'madina_mazarat_date' => $madinaMazaratDate ?? '',

            'adult' => $bookingData->adult ?? '',
            'child_bed' => $bookingData->child ?? '',

            'logo' => 'assets/img/transport_voucher/logo.png',
        ];

        // Generate the PDF using the data
        $pdf = Pdf::loadView('admin.pnr.pnr-transport-voucher-pdf-component', $data)->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        $docName = "PNR_TRANSPORT_VOUCHER_" . time() . ".pdf";


        // Stream the PDF for download
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }





    public function Fairandticket($id)
    {
        // dd($id);
        $this->fireticket = Booking::where('pnr_id', $id)
            ->with('agency', 'guestdetail', 'pnr', 'city')
            ->orderBy('id', 'desc')
            ->get();
        // dd($this->fireticket);

        $serialNumber = 1;
        $resultArray = $this->fireticket->map(function ($pnr) use (&$serialNumber) {
            // dd($pnr->guestdetail);

            return  [
                'Serial No.'            => $serialNumber++,
                'Travel_City'           => $pnr->city->city_name ?? '-',
                'Confir_no'             => $pnr->booking_id ?? '-',
                'Gender'                => isset($pnr->guestdetail->gender) && !empty($pnr->guestdetail->gender) ? $pnr->guestdetail->gender : '-',
                // 'Relation' => !empty($pnr->guestdetail->relation->relation)
                //     ? $pnr->guestdetail->relation->relation
                //     : '-',

                'Name'                  => !empty($pnr->guestdetail->guest_first_name) && !empty($pnr->guestdetail->guest_last_name)
                    ? $pnr->guestdetail->guest_first_name . ' ' . $pnr->guestdetail->guest_last_name
                    : '-',
                'Age' => !empty($pnr->guestdetail->date_of_birth)
                    ? \Carbon\Carbon::parse($pnr->guestdetail->date_of_birth)->age
                    : '-',

                'Passport_Number' => !empty($pnr->guestdetail->passport_number)
                    ? $pnr->guestdetail->passport_number
                    : '-',

                'Date_of_birth' => !empty($pnr->guestdetail->date_of_birth)
                    ? \Carbon\Carbon::parse($pnr->guestdetail->date_of_birth)->format('d-m-Y')
                    : '-',

                'Date_of_Expiry' => !empty($pnr->guestdetail->date_of_expiry)
                    ? \Carbon\Carbon::parse($pnr->guestdetail->date_of_expiry)->format('d-m-Y')
                    : '-',
            ];
        })->toArray();

        // dd($resultArray);

        return Helper::exportToExcel($resultArray, 'Fairandticket.xlsx');
    }

    public function Airlineformat($id)
    {
        $this->airlineformat = Booking::with('agency', 'guestdetail', 'pnr', 'city')
            ->where('pnr_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($this->airlineformat);

        $serialNumber = 1;
        $resultArray = $this->airlineformat->map(function ($airline) use (&$serialNumber) {
            // dd($airline);

            return  [
                'Serial No.'            => $serialNumber++,
                'Gender'                => isset($airline->guestdetail->gender) && !empty($airline->guestdetail->gender) ? $airline->guestdetail->gender : '-',
                'Name'                  => !empty($airline->guestdetail->guest_first_name) && !empty($airline->guestdetail->guest_last_name)
                    ? $airline->guestdetail->guest_first_name . ' ' . $airline->guestdetail->guest_last_name
                    : '-',
                'Passport_Number' => !empty($airline->guestdetail->passport_number)
                    ? $airline->guestdetail->passport_number
                    : '-',
                'Date_of_birth' => !empty($airline->guestdetail->date_of_birth)
                    ? \Carbon\Carbon::parse($airline->guestdetail->date_of_birth)->format('d-m-Y')
                    : '-',

                'Date_of_Expiry' => !empty($airline->guestdetail->date_of_expiry)
                    ? \Carbon\Carbon::parse($airline->guestdetail->date_of_expiry)->format('d-m-Y')
                    : '-',
            ];
        })->toArray();

        // dd($resultArray);

        return Helper::exportToExcel($resultArray, 'Airlineformat.xlsx');
    }

    public function Roomplan($id)
    {
        $bookings = Booking::where('pnr_id', $id)
            ->where('shairing_type', '!=', '')
            ->orderByRaw("shairing_type LIKE '%Single Sharing%' DESC")
            ->orderByRaw("shairing_type LIKE '%Double Sharing%' DESC")
            ->orderByRaw("shairing_type LIKE '%Triple Sharing%' DESC")
            ->orderByRaw("shairing_type LIKE '%Quad Sharing%' DESC")
            ->orderByRaw("shairing_type LIKE '%Quint Sharing%' DESC")
            ->orderBy('shairing_type', 'asc')
            ->get();

        $resultsingle = [];
        $result = [];
        $totals = [
            'Quint' => 0,
            'Quad' => 0,
            'Triple' => 0,
            'Double' => 0,
            'Single' => 0,
            'General' => 0,
        ];

        foreach ($bookings as $booking) {
            $guestDetails = GuestDetail::where('booking_id', $booking->id)->get();

            foreach ($guestDetails as $guestDetail) {
                $relation = Relation::find($guestDetail->relation_with_mehram);
                $birthDate = Carbon::parse($guestDetail->date_of_birth);
                $guestAge = $birthDate->isPast() ? $birthDate->age : '';

                $sharingType = $booking->shairing_type;
                $totals[explode(' ', $sharingType)[0]]++;

                $resultsingle = [
                    'Room' => $room ?? '-',
                    'Gender' => ucwords($guestDetail->gender),
                    'Relation' => $relation->relation ?? '-',
                    'Name' => $guestDetail->guest_first_name . ' / ' . $guestDetail->guest_last_name,
                    'Age' => $guestAge,
                    'Passport_Number' => $guestDetail->passport_number,
                    'Shairing_Type' => $sharingType,
                    'Visa_Number' => $guestDetail->visa_number,
                ];

                $result[] = $resultsingle;
            }
        }

        // Summarizing rooms and pax
        foreach ($totals as $type => $count) {
            if ($count > 0) {
                $resultsingle = [
                    'Room' => $type,
                    'Gender' => ceil($count / $this->getSharingFactor($type)),
                    'Relation' => $count,
                    'Name' => '',
                    'Age' => '',
                    'Passport_Number' => '',
                    'Shairing_Type' => '',
                    'Visa_Number' => '',
                ];
                $result[] = $resultsingle;
            }
        }

        // Add additional data rows
        $result[] = [
            'Room' => 'Total',
            'Gender' => array_sum(array_map(function ($count, $type) {
                return ceil($count / $this->getSharingFactor($type));
            }, $totals, array_keys($totals))),
            'Relation' => array_sum($totals),
            'Name' => '',
            'Age' => '',
            'Passport_Number' => '',
            'Shairing_Type' => '',
            'Visa_Number' => '',
        ];

        $resFacility = Pnr::find($id); // Assuming ResFacility is a model related to Booking
        $toDate = Carbon::parse($resFacility->dept_date)->addDays(ceil($resFacility->days / 2));

        $result[] = [
            'Room' => '',
            'Gender' => 'Makkah',
            // 'Relation' => $resFacility->dept_date->format('d M Y') . " TO " . $toDate->format('d M Y'),
            'Name' => '',
            'Age' => '',
            'Passport_Number' => '',
            'Shairing_Type' => '',
            'Visa_Number' => '',
        ];

        $result[] = [
            'Room' => '',
            'Gender' => 'Madina',
            // 'Relation' => $toDate->format('d M Y') . " TO " . $resFacility->return_date->format('d M Y'),
            'Name' => '',
            'Age' => '',
            'Passport_Number' => '',
            'Shairing_Type' => '',
            'Visa_Number' => '',
        ];

        $result[] = [
            'Room' => '',
            'Gender' => 'Transport By',
            'Relation' => $resFacility->transco_name,
            'Name' => '',
            'Age' => '',
            'Passport_Number' => '',
            'Shairing_Type' => '',
            'Visa_Number' => '',
        ];
        // dd($result);
        return Helper::exportToExcel($result, 'Airlineformat.xlsx');
    }

    private function getSharingFactor($type)
    {
        switch ($type) {
            case 'Single':
                return 1;
            case 'Double':
                return 2;
            case 'Triple':
                return 3;
            case 'Quad':
                return 4;
            case 'Quint':
                return 5;
            case 'General':
                return 6;
            default:
                return 1;
        }
    }

    public function getpassangerModalContent($pnr_id)
    {

        $booking = Booking::where('pnr_id', $pnr_id)->first();  // Using first() to get the first result


        if ($booking) {

            $guestDetails = GuestDetail::where('booking_id', $booking->booking_id)->get();


            if ($guestDetails->isNotEmpty()) {
                $this->passenger_modaldata = $guestDetails;
            } else {
                $this->passenger_modaldata = null;
            }
        } else {
            $this->passenger_modaldata = null;
        }

        // Debugging output
        // dd($this->passenger_modaldata);
    }


    public function getBookingContent($pnr_id)
    {

        // Retrieve the booking based on pnr_id
        $bookings = Booking::where('pnr_id', $pnr_id)->get();
        // dd($bookings);
        // Check if any bookings exist and inspect their content
        if ($bookings->isNotEmpty()) {
            // Get the first booking from the collection
            $this->booking_modal_data = $bookings->first();
        } else {
            session()->flash('error', 'No booking found for the selected PNR.');
        }
    }

    public function render()
    {
        // dd($this->getPnr());
        return view('admin.pnr.pnr-list-component', [
            'pnrData' => $this->getPnr()
        ]);
    }
}
