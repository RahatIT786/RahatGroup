<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use App\Models\Cars;
use App\Models\CarSectorMaster;
use App\Models\TransportEnquiry;
use App\Models\Staff;
use App\Models\AdminSetting;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Mail\TransportEnquiryEmail;
use Illuminate\Support\Facades\Mail;

class TransportdetailsComponent extends Component
{
    public $car, $carsectormaster, $captchaImage;

    #[Validate('required')]
    public $pickup_from;
    #[Validate('required')]
    public $sector_name;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $pickup_date;
    #[Validate('required')]
    public $pickup_time;
    #[Validate('required')]
    public $nationality;
    #[Validate('required')]
    public $mobile_home;
    #[Validate('required')]
    public $mobile_saudi;
    #[Validate('required')]
    public $whatsapp_num;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $userInput;

    public function mount($id)
    {
        // dd($id);
        $this->generateCaptcha();
        $this->carsectormaster = CarSectorMaster::pluck('sector_name', 'id');
        $this->car = Cars::with('carimages')->where('id', $id)->first();
        // dd($this->car);
        if ($this->car) {
            $this->sector_name = $this->car->car_sector_id;
        }
    }

    public function validationAttributes()
    {
        return [
            'pickup_from' => 'Pickup Location',
            'sector_name' => 'Sector',
            'name' => 'Full Name',
            'email' => 'Email Address',
            'pickup_date' => 'Pickup Date',
            'pickup_time' => 'Pickup Time',
            'nationality' => 'Nationality',
            'mobile_home' => 'Home Mobile Number',
            'mobile_saudi' => 'Saudi Mobile Number',
            'whatsapp_num' => 'WhatsApp Number',
            'address' => 'Address',
            'description' => 'Remarks',
            'userInput' => 'Captcha',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        if ($this->userInput !== session('captcha_code')) {
            $this->addError('userInput', 'Invalid CAPTCHA code.');
            return;
        }

        $validated['sector_id'] = $this->sector_name;
        $validated['unique_id'] = Helper::generateUniqueId();
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {
            $transportEnquiry = TransportEnquiry::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new TransportEnquiryEmail($transportEnquiry, $randomStaff,$adminSetting, $adminwhatsapp));

            session()->flash('enquiry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');
            $this->generateCaptcha();
            $this->pickup_from = null;
            $this->name = null;
            $this->email = null;
            $this->pickup_date = null;
            $this->pickup_time = null;
            $this->nationality = null;
            $this->mobile_home = null;
            $this->mobile_saudi = null;
            $this->whatsapp_num = null;
            $this->address = null;
            $this->description = null;
            $this->userInput = null;
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
        session(['captcha_code' => $text]);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.transportdetails-component');
    }
}
