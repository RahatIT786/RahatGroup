<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Attributes\Layout;
use App\Models\Country;
use Livewire\Component;
use App\Helpers\Helper;
use App\Models\TouristVisa;
use App\Models\Staff;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use App\Mail\TouristVisaInquiryEmail;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Request;

class CustomerTouristVisaComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $captchaImage, $id, $visa_type, $cust_name, $cust_email, $cust_mob, $cust_nationality, $cust_pp_front, $cust_pp_back, $cust_emirate_id, $country_id;
    public $country = [], $selectedVisa, $selectedCountry;
    public $userInput;

    public function mount()
    {
        $this->selectedVisa = Request::query('id') ?? null; // Retrieve the visa ID from the query string
        $this->selectedCountry = Request::query('country_id') ?? null; // Retrieve the country ID from the query string

        // Set the visa_type to the value of selectedVisa, which is derived from the query parameter
        $this->visa_type = $this->selectedVisa;
        $this->country_id = $this->selectedCountry;
        // dd($this->selectedVisa, $this->selectedCountry);

        // Generate CAPTCHA on initial load
        $this->generateCaptcha();
        $this->country = Country::pluck('countryname', 'id')->toArray();
    }

    protected function getVisaType($visaId)
    {
        // Assuming you have a Visa model that relates visa ID to types
        $visa = TouristVisa::find($visaId);
        return $visa ? $visa->type : null; // Adjust this based on your actual model structure
    }


    public function save()
    {
        // if ($this->userInput !== session('custmers_captcha_visa')) {
        //     $this->addError('userInput', 'Invalid CAPTCHA code.');
        //     return;
        // }
        // $this->resetErrorBag('userInput');
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
                'cust_emirate_id' => 'required|image',
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
                'cust_emirate_id' => 'Emirate ID',
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

        $uuid = Str::uuid();
        $imageExtension = $validated['cust_emirate_id']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/tourist-visa', $validated['cust_emirate_id'], $imageName);
        $validated['cust_emirate_id'] = $imageName;

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
            session()->flash('customer_visa_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');


            $this->reset(); // Optionally, reset form fields

            return redirect()->route('customer.customer-tour-visa');
        }
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


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.customer-tourist-visa-component');
    }
}
