<?php

namespace App\Http\Controllers\UserFront;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Packages;
use App\Models\PackageType;
use App\Models\City;
use App\Models\HotelMaster;
use App\Models\Country;
use Carbon\Carbon;

use App\Models\Pnr;

class PackagesFilterComponent extends Component
{
    // public $selectedPackage = null; // Property for the selected package
    public $packages = [], $packageTypes, $selecthotelname, $selectstarrating, $selectcity, $type_ids, $selectedcountry, $selectedvisa, $month;
    public $hotel_name, $cityData, $city_id, $ratings, $star_rating, $star_ratings = [], $hotels = [], $country;
    public $umrahpackages, $package, $packageType, $packageziyarat, $packageTypeziyarat, $selectedziyaratpackage, $selectedziyaratpackageType, $hajjPackage, $selectedhajjPackageType, $ramzaanPackage, $ramzaanPackageType;
    public $departureCities, $months, $umrahcity, $umrahmonth;

    public function mount()
    {
        // Initialize the packages property
        // $this->packages = Packages::where('service_id', 1)->pluck('name', 'id')->toArray();
        // $this->packageTypes =PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type','id')->toArray();
        $this->packages = Packages::where('service_id', 1)->pluck('name', 'id')->toArray();
        $pkgTypeIds = Packages::where('service_id', 1)->pluck('type_ids')->flatten()->unique()->toArray();

        $this->umrahpackages = Packages::where('service_id', 2)->pluck('name', 'id')->toArray();
        $pkgTypeIds = Packages::where('service_id', 2)->pluck('type_ids')->flatten()->unique()->toArray();

        if (!empty($pkgTypeIds)) {
            $this->packageTypes = PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type', 'id')->toArray();
        } else {
            $this->packageTypes = []; // Handle case when there are no package type IDs
        }


        // $this->package = Packages::where('service_id', 20)->pluck('name', 'id')->toArray();
        // $pkgTypeIds = Packages::where('service_id', 20)->pluck('type_ids')->flatten()->unique()->toArray();

        // if (!empty($pkgTypeIds)) {
        //     $this->packageType = PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type', 'id')->toArray();
        // } else {
        //     $this->packageType = []; // Handle case when there are no package type IDs
        // }
        $this->loadramzaanPackages();
        $this->loadziyaratPackages();


        $this->cityData = HotelMaster::select('city_id')
            ->distinct()
            ->with('city')
            ->get()
            ->pluck('city.city_name', 'city_id')
            ->toArray();

        $this->star_ratings = HotelMaster::groupBy('star_rating')
            ->pluck('star_rating', 'star_rating')
            ->toArray();

        // Load initial hotels data
        $this->hotels = HotelMaster::active()->pluck('hotel_name', 'id')->toArray();

        $this->country = Country::pluck('countryname', 'id')->toArray();
        $this->cityData = City::pluck('city_name', 'id');

        // Fetch distinct departure cities for active PNRs

        $this->departureCities = Pnr::select('dept_city_id')
        ->active()
        ->distinct()
        ->with('city')
        ->get();
     
        // Fetch unique months and years from dept_date
        $pnrs = Pnr::selectRaw('MONTH(dept_date) as month, YEAR(dept_date) as year')
            ->distinct()
            ->get();

        $futureMonths = [];

        foreach ($pnrs as $pnr) {
            $monthIndex = $pnr->month;
            $year = $pnr->year;

            // Store month and year in the futureMonths array
            $futureMonths[$monthIndex . '-' . $year] = [
                'month' => Carbon::create()->month($monthIndex)->format('F'),
                'year' => $year,
            ];
        }

        // Assign the months array to the component property
        $this->months = $futureMonths;
    }

    public function loadramzaanPackages()
    {

        $this->package = Packages::where('service_id', 20)->pluck('name', 'id')->toArray();
        $pkgTypeIds = Packages::where('service_id', 20)->pluck('type_ids')->flatten()->unique()->toArray();
        $this->packageType = !empty($pkgTypeIds)
            ? PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type', 'id')->toArray()
            : [];
    }

    public function loadziyaratPackages()
    {

        $this->packageziyarat = Packages::where('service_id', 21)->pluck('name', 'id')->toArray();
        $pkgTypeIds = Packages::where('service_id', 21)->pluck('type_ids')->flatten()->unique()->toArray();
        $this->packageTypeziyarat = !empty($pkgTypeIds)
            ? PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type', 'id')->toArray()
            : [];
    }

    // public function search()
    // {
    //     // Check if both dropdowns are empty
    //     if (empty($this->hajjPackage) && empty($this->selectedhajjPackageType)) {
    //         // Add errors to both fields
    //         $this->addError('hajjPackage', 'Please select at least one option (package or subcategory).');
    //         $this->addError('selectedhajjPackageType', 'Please select at least one option (package or subcategory).');
    //         return; // Stop further execution if no option is selected
    //     }

    //     // Redirect to the desired route with the selected package and type
    //     return redirect()->route('customer.hajjPackage', [
    //         'id' => $this->hajjPackage,
    //         'type_ids' => $this->selectedhajjPackageType,
    //     ]);
    // }


    public function search()
    {
        return redirect()->route('customer.hajjPackage', [
            'id' => $this->hajjPackage ?? null,
            'type_ids' => $this->selectedhajjPackageType ?? null,
        ]);
    }

    public function searchhotel()
    {
        // dd($this->umrahcity, $this->umrahmonth);
        return redirect()->route('customer.hotels', [
            'id' => $this->selecthotelname ?? null,
            'city_id' => $this->selectcity ?? null,
            'star_rating' => $this->selectstarrating ?? null,
        ]);
    }

    // public function searchramzaan()
    // {
    //     // Check if both dropdowns are empty
    //     if (empty($this->ramzaanPackage) && empty($this->ramzaanPackageType)) {
    //         // Add errors to both fields
    //         $this->addError('ramzaanPackage', 'Please select at least one option (package or subcategory).');
    //         $this->addError('ramzaanPackageType', 'Please select at least one option (package or subcategory).');
    //         return; // Stop further execution if no option is selected
    //     }

    //     // Redirect to the desired route with the selected package and type
    //     return redirect()->route('customer.ramzanPackages', [
    //         'id' => $this->ramzaanPackage,
    //         'package_type' => $this->ramzaanPackageType,
    //     ]);
    // }

    public function searchramzaan()
    {
        return redirect()->route('customer.ramzanPackages', [
            'id' => $this->ramzaanPackage ?? null,
            'package_type' => $this->ramzaanPackageType ?? null,
        ]);
    }

    public function searchziyarat()
    {
        return redirect()->route('customer.ziyaratPackages', [
            'id' => $this->selectedziyaratpackage ?? null,
            'package_type' => $this->selectedziyaratpackageType ?? null,
        ]);
    }

    // public function searchziyarat()
    // {
    //     // Check if both dropdowns are empty
    //     if (empty($this->selectedziyaratpackage) && empty($this->selectedziyaratpackageType)) {
    //         // Add errors to both fields
    //         $this->addError('selectedziyaratpackage', 'Please select at least one option (package or subcategory).');
    //         $this->addError('selectedziyaratpackageType', 'Please select at least one option (package or subcategory).');
    //         return; // Stop further execution if no option is selected
    //     }

    //     // Redirect to the desired route with the selected package and type
    //     return redirect()->route('customer.ziyaratPackages', [
    //         'id' => $this->selectedziyaratpackage,
    //         'package_type' => $this->selectedziyaratpackageType,
    //     ]);
    // }

    public function searchvisa()
    {
        return redirect()->route('customer.customer-tour-visa', [
            'id' => $this->selectedvisa ?? null,
            'country_id' => $this->selectedcountry ?? null,
        ]);
    }

    public function getPnrList()
    {
        $current_year = date('Y');
        $currMonth = $this->month < 10 ? "0" . $this->month : $this->month;
        $this->start_date = "$current_year-$currMonth-01";
        $this->end_date = date('Y-m-t', strtotime($this->start_date));

        return Pnr::with('flight') // Eager load flightdetails relationship
            ->search('dept_city_id', $this->city_id)
            ->when(!empty($this->month) && !empty($this->start_date) && !empty($this->end_date), function ($q) {
                $q->whereBetween('dept_date', [$this->start_date, $this->end_date]);
            })
            ->desc()
            ->paginate($this->perPage);
    }

    public function pendingSeatData()
    {
        return redirect()->route('customer.umrahPackage', [
            'id' => $this->umrahcity ?? null,
            'month' => $this->umrahmonth ?? null,
        ]);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.packages-filter-component');
    }
}
