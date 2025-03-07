<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\PackageType;
use App\Models\Packages;
use Livewire\Component;
use Livewire\Attributes\Layout;

class HajjPackagesComponent extends Component
{
    public $packages;
    public $packageType;
    public $searchTerm = '';
    public $packagetype = [];
    public $selectedFlavour = [];
    public $flavour = [];

    public function mount()
    {
        $this->packages = Packages::with('pkgDetails')->get();
        $this->initializeFlavours();
        $this->initializePackageTypes();
    }

    public function initializeFlavours()
    {
        foreach ($this->packages as $key => $package) {
            $this->flavour[$key] = $package->pkgDetails;
            $this->selectedFlavour[$key] = $package->pkgDetails->first();
        }
    }

    public function initializePackageTypes()
    {
        $this->packageType = Packages::with('pkgDetails')
            ->get()
            ->pluck('pkgDetails')
            ->flatten()
            ->unique('pkg_type_id')
            ->pluck('pkg_type_name', 'pkg_type_id');
    }

    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->packagetype = [];
        $this->mount();
    }

    public function getPackageType($packageTypeId)
    {
        // Your filtering logic here
    }

    public function selectedflavour($value, $key)
    {
        $this->selectedFlavour[$key] = $this->flavour[$key]->where('pkg_type_id', $value)->first();
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.hajj-packages-component');
    }
}
