<?php

namespace App\Http\Controllers\UserFront;

use App\Models\CustomerTestimonial;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Partner;
use App\Models\HotelMaster;
use App\Models\Packages;
use App\Models\Pnr;
use App\Helpers\Helper;
use Carbon\Carbon;

class UserHomePageComponent extends Component
{
    public $partners, $testimonials, $hotels, $packages, $departureCities, $months;

    // public function mount()
    // {
    //     // Fetch the partner data and testimonials
    //     $this->partners = Partner::all();
    //     $this->testimonials = CustomerTestimonial::desc()->active()->get();

    //     // Fetch the hotels and assign them to the component's $hotels property
    //     $this->hotels = HotelMaster::select('id', 'hotel_name', 'star_rating')->get();
    //     // $this->packages = Packages::select('id', 'name')
    //     // ->where('is_active', 1) // Assuming 1 means active
    //     // ->get();
    //     // $this->packages = Packages::where('service_id', 2)->pluck('name', 'id')->toArray();


    //     $this->departureCities = Pnr::select('dept_city_id')->distinct()->with('city')->active()->get();

    //     $this->packages = Packages::where([
    //         ['is_active', 1],  // Only active packages
    //         ['service_id', 2],
    //         ['umrah_type', 1]
    //     ])->select('id', 'name')->get();
    // }

    public function mount()
    {
        // Fetch partners and testimonials
        $this->partners = Partner::all();
        $this->testimonials = CustomerTestimonial::desc()->active()->get();

        // Fetch hotels
        $this->hotels = HotelMaster::select('id', 'hotel_name', 'star_rating')->get();

        // Fetch active Umrah packages
        $this->packages = Packages::where([
            ['is_active', 1],
            ['service_id', 2],
            ['umrah_type', 1]
        ])->select('id', 'name')->get();

        // Fetch distinct departure cities for active PNRs
        $this->departureCities = Pnr::select('dept_city_id', 'pack_id')
            ->distinct()
            ->with('city:id,city_name') // Eager load city
            ->active()
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

    // Define a method to get packages based on selected city
    public function getPackagesForCity($cityId)
    {
        // Get all PNRs for the selected city
        $pnrs = Pnr::where('dept_city_id', $cityId)->get();
        // dd($pnrs);
        // Collect package IDs
        $packageIds = [];
        foreach ($pnrs as $pnr) {
            $packageIds = array_merge($packageIds, explode(',', $pnr->pack_id));
        }

        // Fetch unique packages based on the collected IDs
        return Packages::whereIn('id', array_unique($packageIds))->get();
    }


    public function getPackagesAttribute()
    {
        // Parse the comma-separated package IDs
        $packageIds = explode(',', $this->pack_id);

        // Return the associated packages
        return Packages::whereIn('id', $packageIds)->get();
    }




    #[Layout('user-front.layouts.app')]
    public function render()
    {
        // Pass $this->hotels to the view
        return view('user-front.user-home-page-component', [
            'hotels' => $this->hotels,
            'packages' => $this->packages,
            'departureCities' => $this->departureCities,
        ]);
    }
}
