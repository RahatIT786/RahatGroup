<?php

namespace App\Http\Controllers\UserFront\Pages;

use App\Models\PackageType;
use App\Models\Packages;
use Livewire\Component;
use App\Models\Pnr;
use App\Models\City;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class RamzanPackagesComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $packages = [], $allIncludes, $cities, $months;
    public $flavour = [], $flavourPrice = [], $packageId = [], $packageType;
    public $selectedFlavour = [], $selectedFlavourPrice = [];
    public $package_id, $packagetype;
    public $selectedPackageTypes = [], $selectedMonth = [], $selectedCity = [], $perPage = 10;
    public $search_package = '';
    public $package, $cityId, $monthParam, $ummonth, $monthPkg, $flavour_changed = false;
    public $packagesPerPage = 10,$totalPackages = 0;
    public $minPrice = 5000;
    public $maxPrice = 500000;
    public $minNights = 3;
    public $maxNights = 30;

    public function mount()
    {
        $this->cityId = Request::query('id');

        $this->monthParam = Request::query('month'); // Fetch the month parameter


        // If you want to extract month and year separately
        if ($this->monthParam) {
            list($month, $year) = explode('-', $this->monthParam);
            $this->monthParam = [$month, $year]; // Store them as an array or assign them to separate properties
        }

        $this->packageType = PackageType::pluck('package_type', 'id');

        $this->fetchPackages();
        // Initialize package flavours
        foreach ($this->packages as $packageKey => $package) {
            $this->initializePackageFlavours($package, $packageKey);
        }
        $this->allIncludes = Helper::packageIncludesOptions();
        $this->cities = City::whereIn('id', Pnr::select('dept_city_id')->distinct()->pluck('dept_city_id'))
            ->pluck('city_name', 'id')
            ->toArray();
        $this->months = Helper::months();

        // Get the current date
        $currentDate = Carbon::now();

        // Initialize the months array
        $futureMonths = [];

        // Loop through 12 months starting from the current month
        for ($i = 0; $i < 12; $i++) {
            // Add months to the current date
            $monthYear = $currentDate->copy()->addMonths($i);

            // Get the numeric representation of the month (1 for January, 2 for February, etc.)
            $monthIndex = $monthYear->month;

            $futureMonths[$monthIndex] = [
                'month' => $monthYear->format('F'),
                'year' => $monthYear->format('Y')
            ];
        }
        // Assign the months array to the component property
        $this->months = $futureMonths;
    }

    private function loadFutureMonths()
    {
        $currentDate = Carbon::now();
        $futureMonths = [];

        for ($i = 0; $i < 12; $i++) {
            $monthYear = $currentDate->copy()->addMonths($i);
            $monthIndex = $monthYear->month;

            $futureMonths[$monthIndex] = [
                'month' => $monthYear->format('F'),
                'year' => $monthYear->format('Y')
            ];
        }
        return $futureMonths;
    }


    public function changeflavour($value, $index)
    {

        // $this->putInCache($value);
        foreach ($this->flavour[$index] as $flavour_single) {
            if ($flavour_single['pkg_type_id'] == $value) {
                $this->selectedFlavour[$index] = $flavour_single;
                $this->selectedFlavourPrice[$index] = $flavour_single['price'];
            }
        }

        $this->flavour_changed = true;

    }

    public function putInCache($value, $flag = null)
    {

        Cache::put('pkg_flavour', $value, now()->addMinutes(10)); // Cache for 30 minutes
        if (!empty($flag))
            return redirect()->route('umrahPackagesView', ['id' => $flag]);
    }

    public function updated($propertyName)
    {
        
        if ($propertyName === 'minPrice' && $this->minPrice > $this->maxPrice) {
            $this->maxPrice = $this->minPrice;
        }

        if ($propertyName === 'maxPrice' && $this->maxPrice < $this->minPrice) {
            $this->minPrice = $this->maxPrice;
        }
        // dd($this->minPrice,$this->maxPrice);
    }

    public function viewDetails(){ }

    public function fetchPackages()
    {
        // Fetch all Pnr entries and extract pack_ids
        $pnrEntries = Pnr::all();
        $pack_ids = $pnrEntries->flatMap(function ($pnr) {
            return explode(',', $pnr->pack_id); // Split the pack_id string into an array
        })->unique(); // Get unique pack_ids

        // Initialize $city_pkg and $month_pkg to empty collections
        $city_pkg = collect();
        $month_pkg = collect();
        $select_city_pkg = collect();

        // If a city is selected, fetch the relevant package IDs (pack_id)
        if (!empty($this->selectedCity)) {
            $cityPnrs = Pnr::whereIn('dept_city_id', $this->selectedCity)->get(); // Fetch Pnr entries first
            $city_pkg = $cityPnrs->flatMap(function ($pnr) {
                return explode(',', $pnr->pack_id); // Split the pack_id string
            })->unique(); // Get unique pack_ids
        }

        if (!empty($this->cityId)) {
            // dd($this->cityId);
            $cityPnrs = Pnr::where('dept_city_id', $this->cityId)->get();
            // dd($cityPnrs);
            $select_city_pkg = $cityPnrs->flatMap(function ($pnr) {
                return explode(',', $pnr->pack_id);
            })->unique();
        }

        // If a month is selected, fetch relevant package IDs (pack_id) for the month
        if (!empty($this->monthParam)) {
            list($month_id, $year) = $this->monthParam; // Assuming you've stored them as an array
            $monthPnrs = Pnr::whereMonth('dept_date', '=', $month_id)
                ->whereYear('dept_date', '=', $year)
                ->get(); // Fetch Pnr entries first

            $month_pkg = $month_pkg->merge($monthPnrs->flatMap(function ($pnr) {
                return explode(',', $pnr->pack_id); // Split the pack_id string
            }))->unique(); // Merge unique pack_ids
        }

        // If a month is selected, fetch relevant package IDs (pack_id) for the month
        if (!empty($this->selectedMonth)) {
            foreach ($this->selectedMonth as $combinedValue) {
                list($month_id, $year) = explode('-', $combinedValue);
                $monthPnrs = Pnr::whereMonth('dept_date', '=', $month_id)
                    ->whereYear('dept_date', '=', $year)
                    ->get(); // Fetch Pnr entries first

                $month_pkg = $month_pkg->merge($monthPnrs->flatMap(function ($pnr) {
                    return explode(',', $pnr->pack_id); // Split the pack_id string
                }))->unique(); // Merge unique pack_ids
            }
        }
        // Fetch packages with filters applied
        $baseQuery = Packages::where('is_active', 1)
            ->where('service_id', 20)
            ->whereIn('id', $pack_ids) // Use the unique pack_ids

            ->when(!empty($this->selectedPackageTypes), fn($q) => $q->whereHas('pkgDetails.packageType', fn($qr) => $qr->whereIn('id', $this->selectedPackageTypes)))
            ->when(!empty($this->selectedCity), function ($query) use ($city_pkg) {
                $query->whereIn('id', $city_pkg);
            })
            ->when(!empty($this->cityId), function ($query) use ($select_city_pkg) {
                $query->whereIn('id', $select_city_pkg);
            })
            ->when(!empty($this->monthParam), function ($query) use ($month_pkg) {
                $query->whereIn('id', $month_pkg->unique()); // Ensure unique values for month package IDs
            })
            ->when(!empty($this->selectedMonth), function ($query) use ($month_pkg) {
                $query->whereIn('id', $month_pkg->unique()); // Ensure unique values for month package IDs
            })
            ->with(['pkgDetails', 'pkgDetails.packageType', 'pkgImages']) // Include related package type
            ->when(!empty($this->search_package), function ($query) {
                $query->searchLike('name', $this->search_package);
            })
            ->when(!empty($this->minPrice) && !empty($this->maxPrice), function ($query) {
                $query->whereHas('pkgDetails', function ($subQuery) {
                    $subQuery->whereBetween('g_share', [$this->minPrice, $this->maxPrice]);
                });
            })
            ->when(!empty($this->minNights) && !empty($this->maxNights), function ($query) {
                $query->whereHas('pnrs', function ($subQuery) {
                    $subQuery->whereBetween('days', [$this->minNights - 1, $this->maxNights - 1]);
                });
            });
            //step 2
            $this->totalPackages = $baseQuery->count();
            // Step 3: Fetch the limited number of records with ->take()
            $this->packages = $baseQuery
            ->with('pkgDetails')  // Include related package type
            ->take($this->packagesPerPage)
            ->get()
            ->sortBy(function ($package) {
                // Sorting by the g_share value from the pkgDetails relationship
                return $package->pkgDetails->min('g_share');
            });

        if ($this->flavour_changed == false) {
            foreach ($this->packages as $packageKey => $package) {

                $this->initializePackageFlavours($package, $packageKey);
            }
        }

    }

    public function changeInput()
    {
        $this->flavour_changed = false;
    }

    public function filterHajj()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    private function initializePackageFlavours($package, $packageKey)
    {
        foreach ($package->pkgDetails as $detailKey => $packageDetail) {
            $this->flavour[$packageKey][$detailKey] = [
                'pkg_type_id' => $packageDetail->pkg_type_id,
                'pkg_type_name' => $packageDetail->packageType != null ? $packageDetail->packageType->package_type : '',
                'price' => $packageDetail->g_share,
                'includes' => $packageDetail->package_includes,
            ];

            $this->flavourPrice[$packageKey][$detailKey] = $packageDetail->g_share;
        }

        // Set the initial selected flavour and price
        $firstDetailKey = array_key_first($this->flavour[$packageKey]);
        $this->selectedFlavour[$packageKey] = $this->flavour[$packageKey][$firstDetailKey] ?? [];
        $this->selectedFlavourPrice[$packageKey] = $this->flavourPrice[$packageKey][$firstDetailKey] ?? 0;
    }

    public function loadMore()
    {
        $this->packagesPerPage += 10; // Increase the number of packages to load
        $this->fetchPackages(); // Re-fetch packages based on the new packagesPerPage value
    }


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.ramzan-packages-component', [
            'packages' => $this->fetchPackages(),
            'packageType' => $this->packageType,
        ]);
    }
}
