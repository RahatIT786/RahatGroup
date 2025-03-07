<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\PackageType;
use App\Models\Packages;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Cache;

class UmrahLandComponent extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $packages = [], $allIncludes;
    public $flavour = [], $flavourPrice = [], $packageId = [];
    public $selectedFlavour = [], $selectedFlavourPrice = [];
    public $package_id, $perPage = 10, $flavour_changed = false;

    public $paginationMeta = [], $packagetype;

    public $selectedPackageTypes = [];
    public $packageType;
    public $search_package = '';
    protected $listeners = ['changeInput'];
    public $packagesPerPage = 10, $totalPackages = 0;
    public $minPrice = 5000;
    public $maxPrice = 500000;

    public function mount()
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->getPackages();


        foreach ($this->packages as $packageKey => $package) {
            $this->initializePackageFlavours($package, $packageKey);
        }
        $this->allIncludes = Helper::packageIncludesOptions();
    }

    // public function changeflavour($value, $index)
    // {

    //     $this->putInCache($value);
    //     foreach ($this->flavour[$index] as $flavour) {
    //         if ($flavour['pkg_type_id'] == $value) {
    //             $this->selectedFlavour[$index] = $flavour;
    //             $this->selectedFlavourPrice[$index] = $flavour['price'];
    //         }
    //     }
    //     $this->flavour_changed = true;
    // }

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
            return redirect()->route('umrahLandPackagesView', ['id' => $flag]);
    }


    public function getPackageType($packagetype)
    {
        $this->packagetype[] = $packagetype;
        $this->getPackages();
    }

    public function changeInput()
    {
        // $this->getPackages();
        $this->flavour_changed = false;
    }

    public function filterHajj()
    {
        // $this->resetPage(); // Reset pagination when the search term changes
        $this->getPackages();
    }
    public function getPackages()
    {
        $baseQuery = Packages::active()
            ->where('service_id', 2)->where('umrah_type', 2)
            ->when(!empty($this->selectedPackageTypes), fn($q) => $q->whereHas('pkgDetails.packageType', fn($qr) => $qr->whereIn('id', $this->selectedPackageTypes)))
            ->searchLike('name', $this->search_package)
            ->with(['pkgDetails.packageType', 'pkgImages']) // Eager load related models
            ->when(!empty($this->minPrice) && !empty($this->maxPrice), function ($query) {
                $query->whereHas('pkgDetails', function ($subQuery) {
                    $subQuery->whereBetween('g_share', [$this->minPrice, $this->maxPrice]);
                });
            })
            ->orderBy(function ($query) {
                $query->select('g_share')
                    ->from('aihut_package_details')
                    ->whereColumn('aihut_package_details.pkg_id', 'aihut_packages.id')
                    ->orderBy('g_share', 'asc')
                    ->limit(1);
            }, 'asc');
        $this->totalPackages = $baseQuery->count();

        $this->packages = $baseQuery
            ->with('pkgDetails')  // Include related package type
            ->take($this->packagesPerPage)
            ->get()
            ->sortBy(function ($package) {
                // Sorting by the g_share value from the pkgDetails relationship
                return $package->pkgDetails->min('g_share');
            });
        // foreach ($this->packages as $packageKey => $package) {
        //     $this->initializePackageFlavours($package, $packageKey);
        // }
        // $this->allIncludes = Helper::packageIncludesOptions();

        // Step 4: Initialize flavours if necessary
        if ($this->flavour_changed == false) {
            foreach ($this->packages as $packageKey => $package) {
                $this->initializePackageFlavours($package, $packageKey);
            }
        }


        if ($this->flavour_changed == false) {
            foreach ($this->packages as $packageKey => $package) {

                $this->initializePackageFlavours($package, $packageKey);
            }
        }
    }


    private function initializePackageFlavours($package, $packageKey)
    {
        // dd($package->pkgDetails);
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

        // Set the initial selected flavour and price
        $firstDetailKey = array_key_first($this->flavour[$packageKey]);
        $this->selectedFlavour[$packageKey] = $this->flavour[$packageKey][$firstDetailKey] ?? [];
        $this->selectedFlavourPrice[$packageKey] = $this->flavourPrice[$packageKey][$firstDetailKey] ?? 0;
        // dd($package, $this->flavour);
    }
    public function loadMore()
    {
        $this->packagesPerPage += 10; // Increase the number of packages to load
        $this->getPackages(); // Re-fetch packages based on the new packagesPerPage value
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.umrah-land-component', [
            'packages' => $this->getPackages(),
            'packageType' => $this->packageType,
        ]);
    }
}
