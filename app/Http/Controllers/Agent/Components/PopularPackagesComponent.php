<?php

namespace App\Http\Controllers\Agent\Components;

use App\Models\Booking;
use App\Models\Packages;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PopularPackagesComponent extends Component
{
    public $perPage = 6, $page = 1, $mostBookedPackageIds;

    // public function getPopularPackages()
    public function mount()
    {
        $this->mostBookedPackageIds = Booking::query()
            ->select('package_name', DB::raw('COUNT(*) as booking_count'))
            ->groupBy('package_name')
            ->orderByDesc('booking_count')
            ->take(20)
            ->pluck('package_name')->toArray();
        // dd($mostBookedPackageIds);
    }

    public function loadMore()
    {
        $this->page++;
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

    public function render()
    {
        return view('agent.components.popular-packages-component', [
            'popular_packages' => $this->getPopularPackages(),
        ]);
    }
}
