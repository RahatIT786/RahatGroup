<?php

namespace App\Http\Controllers\Agent\Packages\PackageDetails;

use App\Models\Bookingenquiry;
use App\Models\City;
use App\Models\FlightMaster;
use App\Models\PackageType;
use App\Models\Packages;
use App\Models\ServiceType;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\Pnr;
use Illuminate\Support\Facades\Cache;

class PackageDescriptionListComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $packages;
    public $captchaImage, $id, $city,  $city_id,$packageId, $package_id,$airline_id;

    public $serviceArray = [], $packageArray = [], $packageType,$subPackageArray = [],$selectedCategory, $selectedFlavour = [], $selectedFlavourPrice = [], $flavour;
    public $cat_id, $selectedPackageFlavourId, $allIncludes, $pkgIncludes, $package_type, $pnr;
    public $g_share, $qt_share, $qd_share, $t_share, $d_share, $single, $child_with_bed, $child_no_bed, $infant, $makkahotel, $madinahotel,$flight;
    public  $dept_dates,$avail_seats;
    
    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $cust_num;

    #[Validate]
    public $travel_date;
    #[Validate]
    public $service_id;

    #[Validate]
    public $food;

    #[Validate]
    public $visa;

    #[Validate]
    public $air_ticket;

    #[Validate]
    public $cust_msg;

    #[Validate]
    public $pkg_type_id;
    #[Validate]
    public $pkg_flavour_id;

    #[Validate]
    public $userInput;
    protected $listeners = ['putInData'];
    public function mount($pkgid)
    {   
        $query = Pnr::with('package', 'city', 'flight')
        ->whereRaw("FIND_IN_SET(?, pack_id)", [$pkgid])
        ->where('dept_date', '>', now())
        ->active();
        $city = $query->pluck('dept_city_id');
        $this->generateCaptcha();
        $this->packageId = $pkgid;
        $this->pkg_flavour_id = Cache::get('pkg_flavour');
        $this->city = City::whereIn('id',$city)->pluck('city_name', 'id');
       
        $this->dept_dates = $query->pluck('dept_date')->unique();
        $flight_ids = $query->pluck('flight_id');
        $this->flight = FlightMaster::whereIn('id',$flight_ids)->pluck('flight_name', 'id')->toArray();


        if(count($this->city) == 0){
           
            $this->city = City::pluck('city_name', 'id');
            
        }
        if( count($this->flight) == 0){
            $this->flight = FlightMaster::pluck('flight_name', 'id')->toArray();

        }
        if(!empty($this->city)){
            $this->city_id = $this->city->keys()->first();
        }
        if($this->city_id != null){
            $this->selectCity();
        }
       
        if($this->dept_dates != null && count($this->dept_dates) > 0){
           
            $this->travel_date = $this->dept_dates[0];
            $this->selectDate();
        }
      
        if($this->flight != null){
            $this->airline_id = array_key_first($this->flight);
            $this->selectFlight();
        }


        $this->selectedCategory = 22; // Default to 'Deluxe'
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->serviceArray = ServiceType::has('packages')->active()->get();
        $this->packages = Packages::where('id', $pkgid)->with('pkgDetails.packageType')->first();
        // $this->generateCaptcha();

        $this->pnr = $query->get();
        
        if ($this->packages) {
            $packageTypeIds = $this->packages->pkgDetails->pluck('packageType.id');
            $this->packageType = PackageType::whereIn('id', $packageTypeIds)->pluck('package_type', 'id');
        } else {
            $this->packageType = collect();
        }
        // dd($packageTypeIds);
        // $this->selectedPackageFlavourId = PackageType::whereIn('id', $packageTypeIds)->first()->id;
        // dd($this->selectedPackageFlavourId);
        $this->selectedPackageFlavourId = $packageTypeIds[0];
        $this->allIncludes = Helper::packageIncludesOptions();
        $firstFlavour = $this->packages->pkgDetails->where('pkg_type_id', $this->selectedPackageFlavourId)->first()->package_includes;
        $this->pkgIncludes = explode(",", $firstFlavour);
        $this->updatePackageIncludes();
        $this->service_id = $this->packages->service_id;
        $this->package_id = $this->packages->id;
        // if ($this->packages && $this->packages->pkgDetails->isNotEmpty()) {
        //     $this->updatePackagePrices($this->packages->pkgDetails->first());

    }
    public function putInData()
    {
       
    }
    public function changeFlavour()
    {
        $this->updatePackageIncludes();
    }

    public function selectCity()
    {   
        // Query PNR with common conditions first
        $query = Pnr::whereRaw("FIND_IN_SET(?, pack_id)", [$this->packageId])
            ->where('dept_date', '>', now())
            ->active();

        // Apply city filter if city_id exists
        if ($this->city_id) {
            $query->where('dept_city_id', $this->city_id);
        }
        
        // Get unique departure dates
        $this->dept_dates = $query->pluck('dept_date')->unique()->values();

       
    }

    public function selectDate()
    {
         // Query PNR with common conditions first
         $query = Pnr::whereRaw("FIND_IN_SET(?, pack_id)", [$this->packageId])
         ->where('dept_date', '>', now())
         ->active();
         // Filter the same query further for flight_ids on selected_date
         if ($this->travel_date) {
           
            $flight_ids = ($query) // Clone the query to avoid modifying the original one
                ->where('dept_date', $this->travel_date)
                ->pluck('flight_id');

            // Get flight names and map them with their IDs
            $this->flight = FlightMaster::whereIn('id', $flight_ids)
                ->pluck('flight_name', 'id')
                ->toArray();
        }
        $this->airline_id = null ;
    }

    public function selectFlight()
    {
       
         // Query PNR with common conditions first
         $query = Pnr::whereRaw("FIND_IN_SET(?, pack_id)", [$this->packageId])
         ->where('dept_date', '>', now())
         ->active();
        if ($this->airline_id) {
            $this->avail_seats = ($query) // Clone the query to avoid modifying the original one
            ->where('flight_id', $this->airline_id)
            ->value('avai_seats');
        }
        // dd($this->avail_seats);
        
    } 

    private function updatePackagePrices($selectedFlavour)
    {
        $this->g_share = $selectedFlavour->g_share;
        $this->qt_share = $selectedFlavour->qt_share;
        $this->qd_share = $selectedFlavour->qd_share;
        $this->t_share = $selectedFlavour->t_share;
        $this->d_share = $selectedFlavour->d_share;
        $this->single = $selectedFlavour->single;
        $this->child_with_bed = $selectedFlavour->child_with_bed;
        $this->child_no_bed = $selectedFlavour->child_no_bed;
        $this->infant = $selectedFlavour->infant;

        // Update hotels
        $this->makkahotel = $selectedFlavour->makkahotel;
        $this->madinahotel = $selectedFlavour->madinahotel;
    }


    private function updatePackageIncludes()
    {
        $selectedFlavour = $this->packages->pkgDetails->where('pkg_type_id', $this->selectedPackageFlavourId)->first();

        if ($selectedFlavour) {
            $this->pkgIncludes = explode(",", $selectedFlavour->package_includes);
            $this->updatePackagePrices($selectedFlavour);
        } else {
            $this->pkgIncludes = [];
        }
    }
    public function generateCaptcha()
    {
        $text = Str::random(6);
        $image = imagecreatetruecolor(120, 40);

        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, 120, 40, $background_color);

        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $text_color);
        }

        imagettftext($image, 20, 0, 10, 30, $text_color, public_path('css/fonts/nunito-v9-latin-600.ttf'), $text);

        ob_start();
        imagepng($image);
        $this->captchaImage = base64_encode(ob_get_clean());
        imagedestroy($image);
        session(['book_now_captcha_code' => $text]);
    }

    public function rules()
    {
        return [
            'city_id' => 'required',
            'travel_date' => 'required|date',
            'airline_id' => 'required',
            'pkg_flavour_id' => 'required',
        ];
    }
    public function changeName()
    {
        // Final validation check before processing
        $this->validate($this->rules());
        // dd($this->rules());

    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.packages.package-details.package-description-list-component');
    }
}
