<?php

namespace App\Http\Controllers\User\Pages;

use App\Helpers\Helper;
use App\Models\TouristVisa;
use App\Models\Country;
use App\Models\Staff;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;
use App\Mail\TouristVisaInquiryEmail;
use App\Models\AdminSetting;


class TouristVisaComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $captchaImage, $id, $visa_type, $cust_name, $cust_email, $cust_mob, $cust_nationality, $cust_pp_front, $cust_pp_back, $cust_emirate_id, $country_id;
    public $country = [];
    public $userInput;

    public function mount()
    {
        $this->country = Country::pluck('countryname', 'id')->toArray();
        // dd($this->country);
        $this->generateCaptcha();
    }

    public function save()
    {
        if ($this->userInput !== session('visa_captcha_code')) {
            $this->addError('userInput', 'Invalid CAPTCHA code.');
            return;
        }
        $this->resetErrorBag('userInput');
        $validated = $this->validate(
            [
                'country_id' => 'required',
                'visa_type' => 'required',
                'cust_name' => 'required',
                'cust_email' => 'required|email',
                'cust_mob' => 'required|min:10',
                'cust_nationality' => 'required',
                'cust_pp_front' => 'required|image',
                'cust_pp_back' => 'required|image',
                'cust_emirate_id' => 'nullable|image',
                'userInput' => 'required',
            ],
            [],
            [
                'country_id' => 'Country',
                'visa_type' => 'Visa Type',
                'cust_name' => 'Name',
                'cust_email' => 'Email',
                'cust_mob' => 'Mobile',
                'cust_nationality' => 'Nationality',
                'cust_pp_front' => 'Passport Front',
                'cust_pp_back' => 'Passport Back',
                'userInput' => 'Captcha Code',
            ]
        );

        $uuid = Str::uuid();
        $imageExtension = $validated['cust_pp_front']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/tourist-visa', $validated['cust_pp_front'], $imageName);
        $validated['cust_pp_front'] = $imageName;

        $uuid = Str::uuid();
        $imageExtension = $validated['cust_pp_back']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/tourist-visa', $validated['cust_pp_back'], $imageName);
        $validated['cust_pp_back'] = $imageName;

        if (isset($validated['cust_emirate_id'])) {
        $uuid = Str::uuid();
        $imageExtension = $validated['cust_emirate_id']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/tourist-visa', $validated['cust_emirate_id'], $imageName);
        $validated['cust_emirate_id'] = $imageName;
        }

        // // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {
            $touristvisa = TouristVisa::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new TouristVisaInquiryEmail($touristvisa, $randomStaff,$adminSetting,$adminwhatsapp));

            // Flash success message
            session()->flash('visa_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            $this->dispatch('reload-page');
            $this->reset(); // Optionally, reset form fields

            return redirect()->route('tour-visa');
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
        session(['visa_captcha_code' => $text]);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.tourist-visa-component');
    }
}
