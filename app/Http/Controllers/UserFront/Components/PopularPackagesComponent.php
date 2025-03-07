<?php

namespace App\Http\Controllers\UserFront\Components;

use App\Models\Booking;
use App\Models\Packages;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PopularPackagesComponent extends Component
{
    public $perPage = 6, $page = 1, $mostBookedPackageIds, $incrementBy = 3;

    // public function getPopularPackages()
    public function mount()
    {
        $this->mostBookedPackageIds = Booking::query()
            ->select('package_name', DB::raw('COUNT(*) as booking_count'))
            ->groupBy('package_name')
            ->orderByDesc('booking_count')
            ->take(20)
            ->pluck('package_name')->toArray();
    }

    public function loadMore()
    {
        $this->perPage += $this->incrementBy;
    }

    public function getPopularPackages()
    {
        $query = Packages::query();
        if ($this->mostBookedPackageIds) {
            $query->whereIn('id', $this->mostBookedPackageIds)->with('pkgImages');
        }
        //make a load more for this
        return $query->paginate($this->perPage * $this->page);
    }

    public function viewPackageDetails($packageId)
    {
        $package = Packages::findOrFail($packageId);
        switch ($package->service_id) {
            case 1: // Hajj Package
                return redirect()->route('customer.hajjPackageView', ['id' => $packageId]);
            case 2: // Ramzan Package
                return redirect()->route('customer.umrahPackageView', ['id' => $packageId]);
            case 20: // Ziyarat Package
                return redirect()->route('customer.ramzanPackagesView', ['id' => $packageId]);
            case 21: // Umrah Package
                return redirect()->route('customer.ziyaratPackagesView', ['id' => $packageId]);
            default:
                return abort(404, 'Package not found');
        }
    }

    public function render()
    {
        return view('user-front.components.popular-packages-component', [
            'popular_packages' => $this->getPopularPackages(),
        ]);
    }
}
