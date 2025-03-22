<?php

namespace App\Http\Controllers\Agent\Website;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Packages;
use \Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\PackageType;
use App\Models\Pnr;
use App\Models\City;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class HomeComponent extends Component
{

    use WithPagination, WithoutUrlPagination;
    // public $packages = [], $allIncludes, $cities, $months;
    // public $flavour = [], $flavourPrice = [], $packageId = [], $packageType;
    // public $selectedFlavour = [], $selectedFlavourPrice = [];
    // public $package_id, $packagetype;
    // public $selectedPackageTypes = [], $selectedMonth = [], $selectedCity = [], $perPage = 10;
    // public $search_package = '';
    // public $package, $cityId, $monthParam, $ummonth, $monthPkg, $flavour_changed = false;
    // public $packagesPerPage = 10, $totalPackages = 0;
    // public $minPrice = 5000;
    // public $maxPrice = 500000;
    // public $minNights = 3;
    // public $maxNights = 30;

    public $email, $password;
    public $packages,$pack_ids;

    public function fetchPackages(){
        $pnrEntries = Pnr::all();
        $pack_ids = $pnrEntries->flatMap(function ($pnr) {
            return explode(',', $pnr->pack_id);
        })->unique();

        return $pack_ids;
    }

    public function index()
    {
        $this->pack_ids = $this->fetchPackages();
        $agent = request()->agent;  // Get the agent from the request
        $this->packages  = Packages::where('is_active', 1)
                                    ->where('service_id', 2)
                                    ->where('umrah_type', 1)
                                    ->whereIn('id', $this->pack_ids)
                                    ->when(!empty($this->selectedPackageTypes), function ($query) {
                                        $query->whereHas('pkgDetails.packageType', function ($subQuery) {
                                            $subQuery->whereIn('id', $this->selectedPackageTypes);
                                        });
                                    })
                                    ->get();
        return view('agent.website.home-component', [
            'agent' => $agent,
            'packages' => $this->packages,
        ]);
    }

    public function loginPost()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        // dd($this->email, $this->password);

        if (auth()->guard('agent')->attempt([$this->email, $this->password])) {
            return redirect()->route('agent-website.dashboard');
        } else {
            throw ValidationException::withMessages([
                $this->email => [trans('auth.failed')],
            ]);
        }
    }


    #[Layout('agent.website.layouts.app')]
    public function render()
    {
        // dd(request()->agent);
        return view('agent.website.home-component', [
            'agent' => request()->agent,
        ]);
    }
}
