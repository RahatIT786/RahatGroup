<?php

namespace App\Http\Controllers\Admin\PackageManagement\PackagesMaster;

use App\Models\City;
use App\Models\FoodMaster;
use App\Models\HotelMaster;
use App\Models\PackageType;
use Livewire\Component;
use App\Models\PackageMaster;
use App\Models\Pnr;
use App\Models\TransportMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
class PackageMasterListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $booking_id, $booking_modal_data = null, $payments_modal_data = null;
    public $showConfirmation = false;
    public $package_name, $package_type;
    public $package, $city, $modalData, $Id, $dept_date,$city_id;
    
    public function mount()
    {
        $this->package = PackageType::orderBy('package_type', 'ASC')->pluck('package_type', 'id');
        $this->city = City::orderBy('city_name', 'ASC')->pluck('city_name', 'id');
    }

    public function filterPackage()
    {
        $this->resetPage();
    }

    public function getPackages()
    {   
        // Fetch packages with related PNR details
        $packages = PackageMaster::select(
            'aihut_package_master.*',
            'aihut_pnr_table.group_name',
            'aihut_pnr_table.dept_date',
            'aihut_pnr_table.adult_cost',
            'aihut_pnr_table.child_cost',
            'aihut_pnr_table.infant_cost',
            'aihut_pnr_table.dept_city_id',
            'aihut_pnr_table.seats'
        )
        ->join('aihut_pnr_table', function ($join) {
            $join->on('aihut_pnr_table.pack_id', 'LIKE', DB::raw("CONCAT('%,', aihut_package_master.id, ',%')"));
        })
        ->searchLike('dept_date', $this->dept_date)
        ->searchLike('package_type', $this->package_type)
        ->searchLike('aihut_pnr_table.dept_city_id', $this->city_id)
        ->paginate($this->perPage);
     
            foreach ($packages as $package) {
                $SarPrice = 1; // Replace with actual SAR Price
                $package_day = $package->days ?? 1;
                $hotelCnt = 2; // Assumed based on provided code
                $laundray = 0; // Replace with actual laundry cost
                $zamzam = 10 * $SarPrice;
                $staffExp = $this->calculateStaffExpense($package->package_type); // Use a method to calculate staff expense
                $visa_price = $this->getVisaPrice($package->dept_date, $SarPrice);
                $transport_price = $this->getTransportPrice($package->transport_type, $SarPrice);
                $food = $this->getFoodPrice($package->food_type, $SarPrice, $package_day);
                $hotel_price = $this->getHotelPrice($package->makka_hotel, $package->madina_hotel, $package->dept_date, $SarPrice, $package_day, $hotelCnt);

                // Calculate final prices
                $package->quint_price = ($hotel_price / 5) + $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->adult_cost;
                $package->quad_price = ($hotel_price / 4) + $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->adult_cost;
                $package->triple_price = ($hotel_price / 3) + $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->adult_cost;
                $package->double_price = ($hotel_price / 2) + $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->adult_cost;
                $package->childbed_price = ($hotel_price / 5) + $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->child_cost;
                $package->child_price = $laundray + $zamzam + $staffExp + $visa_price + $transport_price + $food + $package->child_cost;
                $package->infant_price = $staffExp + $visa_price + $package->infant_cost;
            }
       
        return $packages;
    }
    // Calculate staff expense based on package type
    private function calculateStaffExpense($packageType)
    {
        switch ($packageType) {
            case 'Budget':
                return 1500;
            case 'Deluxe':
                return 2000;
            case 'Super Deluxe':
            case 'Semi Deluxe':
                return 2500;
            case 'Executive':
                return 4500;
            case 'Special HUO':
                return 6000;
            default:
                return 0;
        }
    }

    // Get visa price
    private function getVisaPrice($dept_date, $SarPrice)
    {
        $visaDetails = DB::table('aihut_visa_details')
            ->join('aihut_visa', 'aihut_visa.id', '=', 'aihut_visa_details.visa_id')
            ->where('aihut_visa.visa_name', 'LIKE', '%Umrah%')
            ->where('aihut_visa_details.start_date', '<=', $dept_date)
            ->where('aihut_visa_details.start_date', '>=', $dept_date)
            ->first();

        if ($visaDetails) {
            return $visaDetails->visa_price * $SarPrice;
        } else {
            $visaDetails = DB::table('aihut_visa_details')
                ->join('aihut_visa', 'aihut_visa.id', '=', 'aihut_visa_details.visa_id')
                ->where('aihut_visa.visa_name', 'LIKE', '%Umrah%')
                ->first();
            return $visaDetails->visa_price * $SarPrice;
        }
    }

    // Get transport price
    private function getTransportPrice($transportType, $SarPrice)
    {
        $transport = TransportMaster::find($transportType);
        if ($transport) {
            return ($transport->price / 40) * $SarPrice;
        }
        return 0;
    }

    // Get food price
    private function getFoodPrice($foodType, $SarPrice, $package_day)
    {
        $foodPackage = FoodMaster::find($foodType);
        if ($foodPackage) {
            return $foodPackage->price * $SarPrice * $package_day;
        }
        return 0;
    }

    // Get hotel price based on season
    private function getHotelPrice($makkaHotelId, $madinaHotelId, $dept_date, $SarPrice, $package_day, $hotelCnt)
    {
        $hotel_price = 0;
        $hotel_price += $this->calculateHotelPrice($makkaHotelId, $dept_date, $SarPrice, $package_day, $hotelCnt);
        $hotel_price += $this->calculateHotelPrice($madinaHotelId, $dept_date, $SarPrice, $package_day, $hotelCnt);
        return $hotel_price;
    }

    // Calculate hotel price based on season dates
    private function calculateHotelPrice($hotelId, $dept_date, $SarPrice, $package_day, $hotelCnt)
    {
        if ($hotelId) {
            $hotel = HotelMaster::where('is_active', 1)->find($hotelId);
            if ($hotel) {
                $paymentDate = Carbon::parse($dept_date);
                $price_hotel = 0;

                if ($paymentDate->between(Carbon::parse($hotel->high_start_date), Carbon::parse($hotel->high_end_date))) {
                    $price_hotel = $hotel->high_season_price;
                } elseif ($paymentDate->between(Carbon::parse($hotel->medium_start_date), Carbon::parse($hotel->medium_end_date))) {
                    $price_hotel = $hotel->medium_season_price;
                } elseif ($paymentDate->between(Carbon::parse($hotel->low_start_date), Carbon::parse($hotel->low_end_date))) {
                    $price_hotel = $hotel->low_season_price;
                } else {
                    $price_hotel = $hotel->low_season_price;
                }

                return $price_hotel * $SarPrice * ($package_day / $hotelCnt);
            }
        }
        return 0;
    }
    
    public function confirmed()
    {
        $packageMasterData = PackageMaster::whereId($this->Id);
        $packageMasterData->update(['is_active' => !$packageMasterData->first()->is_active]);
        $this->alert('success', 'Record has been updated successfully');
    }


    public function isDupicate(PackageMaster $packagemaster)
    {
        // dd($packagemaster);
        $this->Id = $packagemaster->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
        // $packageMasterData->delete();
    }

    public function confirmDuplicate()
    {
        try {
            $packageMasterData = PackageMaster::find($this->Id);
            $copypackageMasterData = [
                'package_name' => $packageMasterData->package_name,
                'package_type' => $packageMasterData->package_type,
                'makka_rating' => $packageMasterData->makka_rating,
                'makka_city_id' => $packageMasterData->makka_city_id,
                'makka_hotel' => $packageMasterData->makka_hotel,
                'madina_rating' => $packageMasterData->madina_rating,
                'madina_city_id' => $packageMasterData->madina_city_id,
                'madina_hotel' => $packageMasterData->madina_hotel,
                'package_includes' => $packageMasterData->package_includes,
                'laundray_type' => $packageMasterData->laundray_type,
                'transport_type' => $packageMasterData->transport_type,
                'food_type' => $packageMasterData->food_type,
            ];
            PackageMaster::create($copypackageMasterData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new package master: ' . $e->getMessage());
        }
        $this->alert('success', 'Record has been deleted successfully');
    }
    
    public function render()
    {
        // dd($this->getPackages());
        return view('admin.package-management.packages-master.package-master-list-component', [
            'packages' => $this->getPackages()
        ]);
    }
}
