<?php

namespace App\Http\Controllers\Agent\Packages\PackagePrices;

use App\Helpers\Helper;

use App\Models\PackageDetails;
use App\Models\ServiceType;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Carbon\Carbon;


class PackagePricesListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$search_service_type; // Default number of items per page

    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getPackagePrices()
    {
        return PackageDetails::query()
        ->with('packageType', 'package', 'package.serviceType')
        ->when($this->search_service_type, function ($query) {
            $query->whereHas('package.serviceType', function ($q) {
                $q->where('name', 'like', '%' . $this->search_service_type . '%');
            });
        })
        ->paginate($this->perPage); // Ensure pagination is applied hereto execute the query and fetch results
    }

    public function filterBookings()
    {
         dd('hi');
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        //dd($this->getPackagePrices());
        $packagePrices = $this->getPackagePrices();
        // dd($packageType);


        // dd($packagePrices[0]->packageType);
    return view('agent.packages.package-prices.package-prices-list-component', [
        'packagePrices' => $packagePrices,

        ]);

    }
}
