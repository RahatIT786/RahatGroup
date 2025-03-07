<?php

namespace App\Http\Controllers\User\Pages;

use App\Helpers\Helper;
use App\Models\Bookingenquiry;
use App\Models\City;
use App\Models\FlightMaster;
use App\Models\PackageType;
use App\Models\Packages;
use App\Models\ServiceType;
use App\Models\Staff;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RamzanPackagesInquiryEmail;
use App\Models\AdminSetting;

class RamzanPackageViewModalComponent extends Component
{
    use WithFileUploads;

    public $captchaImage;
    public $packages, $selectedCategory, $packageId, $package_id, $packageType, $pkgDetails, $service_id;
    public $serviceArray = [], $packageArray = [], $subPackageArray = [], $selectedFlavour = [], $selectedFlavourPrice = [], $flavour;
    public $cat_id, $selectedPackageFlavourId, $allIncludes, $pkgIncludes, $package_type;
    public $g_share, $qt_share, $qd_share, $t_share, $d_share, $single, $child_with_bed, $child_no_bed, $infant, $makkahotel, $madinahotel, $city, $flight, $airline_id, $city_id;
    // public $service_id = 20; // Default to service_id 1

    public $flv_sessions_data = [];

    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $cust_num;

    #[Validate]
    public $adults;

    #[Validate]
    public $children;

    #[Validate]
    public $infants;


    #[Validate]
    public $travel_date;

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

    public function mount($id, $travel_date, $city, $airline_id, $flavour_id)
    {
        // dd($id, $travel_date, $city, $airline_id);
        // dd($this->city_id);
        $this->packageId = $id;
        // Access session variables
        $this->pkg_flavour_id = $flavour_id;
        $this->travel_date = $travel_date;
        $this->city_id = $city;
        $this->airline_id = $airline_id;
        $this->city = City::pluck('city_name', 'id');
        $this->flight = FlightMaster::pluck('flight_name', 'id');

        $this->selectedCategory = 22; // Default to 'Deluxe'
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->serviceArray = ServiceType::has('packages')->active()->get();
        $this->packages = Packages::where('id', $id)->with('pkgDetails.packageType')->first();
        $this->generateCaptcha();

        if ($this->packages) {
            $packageTypeIds = $this->packages->pkgDetails->pluck('packageType.id');
            $this->packageType = PackageType::whereIn('id', $packageTypeIds)->pluck('package_type', 'id');
        } else {
            $this->packageType = collect();
        }

        $this->selectedPackageFlavourId = PackageType::whereIn('id', $packageTypeIds)->first()->id;
        $this->allIncludes = Helper::packageIncludesOptions();
        $firstFlavour = $this->packages->pkgDetails->where('pkg_type_id', $this->selectedPackageFlavourId)->first()->package_includes;
        $this->pkgIncludes = explode(",", $firstFlavour);
        $this->updatePackageIncludes();
        $this->service_id = $this->packages->service_id;
        $this->package_id = $this->packages->id;
    }

    public function changeFlavour()
    {
        $this->updatePackageIncludes();
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

    private function updatePackagePrices($selectedFlavour)
    {
        $this->g_share = $selectedFlavour->g_share;
        $this->qt_share = $selectedFlavour->qt_share;
        $this->qd_share = $selectedFlavour->qd_share;
        $this->t_share = $selectedFlavour->t_share;
        $this->d_share = $selectedFlavour->d_share;
        $this->single = $selectedFlavour->single;
        $this->child_with_bed = $selectedFlavour->child_with_bed;
        $this->child_no_bed = $selectedFlavour->chlid_no_bed;
        $this->infant = $selectedFlavour->infant;

        // Update hotels
        $this->makkahotel = $selectedFlavour->makkahotel;
        $this->madinahotel = $selectedFlavour->madinahotel;
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
        session(['book_now_ramzan_captcha_code' => $text]);
    }

    public function rules()
    {
        return [
            'cust_name' => 'required',
            'airline_id' => 'required',
            'city_id' => 'required',
            // 'children' => 'required',
            // 'infants' => 'required',
            'adults' => 'required',
            'cust_email' => 'required|email',
            'cust_num' => 'required|min:10|max:10',
            'travel_date' => 'required|date',
            'food' => 'required',
            'visa' => 'required',
            'air_ticket' => 'required',
            'cust_msg' => 'required',
            'pkg_flavour_id' => 'required',
            'userInput' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'cust_name' => 'Name',
            'airline_id' => 'Airline',
            'city_id' => 'City',
            'cust_email' => 'Email',
            // 'children' => 'children',
            'adults' => 'Adults',
            // 'infants' => 'Infants',
            'cust_num' => 'Mobile',
            'travel_date' => 'Date Of Travel',
            'food' => 'Food',
            'visa' => 'Visa',
            'air_ticket' => 'Airline Ticket',
            'cust_msg' => 'Message',
            'pkg_flavour_id' => 'Package Type',
            'userInput' => 'CAPTCHA',
        ];
    }

    public function save()
    {
        // dd($this->service_id, $this->package_id, $this->pkg_flavour_id);
        if ($this->userInput !== session('book_now_ramzan_captcha_code')) {
            $this->addError('userInput', 'The CAPTCHA code is incorrect.');
            return;
        }
        $validated = $this->validate();

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        $validated['cat_id'] = $this->service_id;
        $validated['pkg_type_id'] = $this->package_id;
        $validated['children'] = $this->children ?? 0;
        $validated['infants'] = $this->infants ?? 0;
        $validated['passengers'] = $this->infants + $this->children + $this->adults;
        if ($validated) {
            $ramzanpackages =  Bookingenquiry::create($validated);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new RamzanPackagesInquiryEmail($ramzanpackages, $randomStaff));

        // Flash success message
        session()->flash('hajj_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
            ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
            ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');
        $this->reset(); // Optionally, reset form fields
        $this->generateCaptcha(); // Generate a new CAPTCHA
        }
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.ramzan-package-view-modal-component');
    }
}
