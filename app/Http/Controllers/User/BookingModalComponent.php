<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Mail\BookNowInquiryEmail;
use App\Models\Bookingenquiry;
use App\Models\ServiceType;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\PackageType;
use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Models\AdminSetting;

class BookingModalComponent extends Component
{
    use WithFileUploads;

    public $captchaImage;
    public $serviceArray = [], $packageArray = [], $subPackageArray = [];

    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $adults;

    #[Validate]
    public $children;

    #[Validate]
    public $infants;

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


    public function mount()
    {
        // $this->packagemaster = PackageMaster::pluck('package_name', 'id')->toArray();
        $this->serviceArray = ServiceType::has('packages')->active()->get();
        $this->generateCaptcha();
    }

    public function generateCaptcha()
    {
        $text = Str::random(6); // Generate random text for CAPTCHA
        $image = imagecreatetruecolor(120, 40); // Create a blank image

        // Set colors
        $background_color = imagecolorallocate($image, 255, 255, 255); // White background
        $text_color = imagecolorallocate($image, 0, 0, 0); // Black text color

        // Fill image with background color
        imagefilledrectangle($image, 0, 0, 120, 40, $background_color);

        // Add random lines to make CAPTCHA harder to read for bots
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $text_color);
        }

        // Add text to image
        imagettftext($image, 20, 0, 10, 30, $text_color, public_path('css/fonts/nunito-v9-latin-600.ttf'), $text);

        // Output the image as base64
        ob_start();
        imagepng($image);
        $this->captchaImage = base64_encode(ob_get_clean());
        imagedestroy($image);

        // Store CAPTCHA code in session
        session(['captcha_code' => $text]);
    }

    public function rules()
    {
        return [
            'cust_name' => 'required',
            'cust_email' => 'required|email',
            'cust_num' => 'required|min:10|max:10',
            'travel_date' => 'required|date',
            // 'passengers' => 'required',
            // 'infants' => 'required',
            'adults' => 'required',
            'food' => 'required',
            'visa' => 'required',
            'air_ticket' => 'required',
            'cust_msg' => 'required',
            'service_id' => 'required',
            'pkg_type_id' => 'required',
            'pkg_flavour_id' => 'required',
            'userInput' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'cust_name' => 'Name',
            'cust_email' => 'Email',
            'cust_num' => 'Mobile',
            'travel_date' => 'Date Of Travel',
            // 'passengers' => 'Passengers',
            'adults' => 'Adults',
            // 'infants' => 'Infants',
            'food' => 'Food',
            'visa' => 'Visa',
            'air_ticket' => 'Airline Ticket',
            'cust_msg' => 'Message',
            'service_id' => 'Service Type',
            'pkg_type_id' => 'Package',
            'pkg_flavour_id' => 'Package Type',
            'userInput' => 'CAPTCHA',
        ];
    }

    public function save()
    {

        // dd($this->userInput, session('book_now_captcha_code'), $this->userInput !== session('book_now_captcha_code'));

        $validated = $this->validate();

        unset($validated['service_id']);
        unset($validated['userInput']);
        $validated['cat_id'] = $this->service_id;

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;
        $validated['children'] = $this->children ?? 0;
        $validated['infants'] = $this->infants ?? 0;
        $validated['passengers'] = $this->infants + $this->children + $this->adults;

        if ($validated) {
            // dd($validated);
            $bookingenquiry = Bookingenquiry::create($validated);
            $adminSetting = AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp = AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            // Send the email to the assigned staff member
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new BookNowInquiryEmail($bookingenquiry, $randomStaff, $adminSetting, $adminwhatsapp));

            // Flash success message
            session()->flash('booking_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            $this->reset(); // Optionally, reset form fields
            $this->generateCaptcha(); // Generate a new CAPTCHA
        }
    }

    public function changeServiceType()
    {
        // dd($this->pkg_type_id);
        $this->pkg_type_id = "";
        $this->packageArray = Packages::where('service_id', $this->service_id)->active()->get();
        $this->subPackageArray = [];
        // dd($this->packageArray);
    }

    public function changePackageType()
    {
        // dd($this->pkg_type_id);
        $type_ids = Packages::whereId($this->pkg_type_id)->first()->type_ids;
        $packageIds = explode(',', $type_ids);
        // dd($packageIds);
        $this->subPackageArray = PackageType::whereIn('id', $packageIds)->active()->get();
        // dd($this->subPackageArray);
    }

    public function render()
    {
        return view('user.booking-modal-component');
    }
}
