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
use App\Models\UserEnquiryForAgent;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request; // Correct import



class HomeComponent extends Component
{

    use WithPagination, WithoutUrlPagination;

    // public $email, $password;
    public $packages,$pack_ids;
    public $name, $email, $mobile, $message, $agent;
    public $agent_id, $agent_name;

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
        $this->agent = request()->agent;  // Get the agent from the request
        //dd($this->agent);
        $this->packages = Packages::where('is_active', 1)
                            ->where('service_id', 2)
                            ->where('umrah_type', 1)
                            ->whereIn('id', $this->pack_ids)
                            ->when(!empty($this->selectedPackageTypes), function ($query) {
                                $query->whereHas('pkgDetails.packageType', function ($subQuery) {
                                    $subQuery->whereIn('id', $this->selectedPackageTypes);
                                });
                            })
                            ->with(['pkgDetails' => function($query) {
                                $query->with(['makkahotel', 'madinahotel','packageType']);
                            }])
                            ->get();


        // dd( $this->packages );
        // dd($this->packages->map(function($package) {
        //     return [
        //         'package_id' => $package->id,
        //         'hotels' => $package->pkgDetails->map(function($detail) {
        //             return [
        //                 'detail_id' => $detail->id,
        //                 'makka_hotel' => $detail->makkahotel->toArray(), // Convert to array
        //                 'madina_hotel' => $detail->madinahotel->toArray(),
        //             ];
        //         })
        //     ];
        // }));

        return view('agent.website.home-component', [
            'agent' => $this->agent,
            'packages' => $this->packages,
        ]);
    }

    public function submitEnquiry(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|numeric|digits:10',
            'message' => 'required|string|max:500',
        ]);

        // Debugging - Display the submitted form data
        // dd($request->all());
        // dd( $this->agent_name );
        // Save to the database
        UserEnquiryForAgent::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'message' => $request->message,
            'agent_id' => $request->agent_id,
            'agent_name' => $request->agent_name,
        ]);

        return redirect()->back()->with('success', 'Your enquiry has been submitted successfully!');
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
