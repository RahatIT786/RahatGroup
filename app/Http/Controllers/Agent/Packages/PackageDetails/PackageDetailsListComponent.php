<?php

namespace App\Http\Controllers\Agent\Packages\PackageDetails;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Packages;
use App\Models\PackageType;
use App\Models\ServiceType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PackageDetailsListComponent extends Component
{
    use LivewireAlert;
    public $packages, $packageType;
    public  $selectedPackageType;
    public $serviceType, $selectedServiceType;

    public function mount()
    {
        // $this->selectedPackageType = 6;
        $this->loadPackages();

        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->serviceType = ServiceType::whereIn('id',[1,2,20,21])->pluck('name', 'id');
        // Select the first item by default
        $this->selectedServiceType = $this->serviceType->keys()->first();
    }

    public function loadPackages()
    {
        $query = Packages::active()->with('pkgDetails.packageType','pkgImages');

        // Filter by selected package type
        // if (!empty($this->selectedPackageType)) {
        //     $query->whereHas('pkgDetails', function ($q) {
        //         $q->where('pkg_type_id', $this->selectedPackageType);
        //     });
        // }

        // Filter by selected service type
        if (!empty($this->selectedServiceType)) {
            $query->where('service_id', $this->selectedServiceType);
        }

        $this->packages = $query->get();

        // dd($this->packages);
    }

    public function updatedSelectedPackageType()
    {
        $this->loadPackages();
    }

    public function updatedSelectedServiceType()
    {
        $this->loadPackages();
    }
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.packages.package-details.package-details-list-component', [
            'packages' => $this->loadPackages(),
            'packageType' => $this->packageType
        ]);
    }
}
