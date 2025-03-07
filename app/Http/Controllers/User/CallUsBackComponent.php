<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Models\CallUsBack;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Country;
use App\Models\City;
use App\Models\Staff;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Mail\CallUsBackInquiryEmail;
use App\Models\AdminSetting;

class CallUsBackComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $cities = [], $countries = [], $captchaImage;
    #[Validate('required')]
    public $country_id;
    #[Validate('required')]
    public $full_name;
    #[Validate('required')]
    public $email_id;
    #[Validate('required')]
    public $callback_time;
    #[Validate('required')]
    public $callback_date;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $mob_num;
    #[Validate('required')]
    public $city_id;
    #[Validate('required')]
    public $userInput;


    public function mount()
    {
        $this->title = 1;
        $this->generateCaptcha();
        $this->countries = Country::all()->pluck('countryname', 'id');
        $this->cities = City::all()->pluck('city_name', 'id');
        // dd($this->generateCaptcha());
    }


    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'title' => 'Title',
            'full_name' => 'Full Name',
            // 'l_name' => 'Last Name',
            'mob_num' => 'Mobile Number',
            'email_id' => 'Email',
            'country_id' => 'Country',
            'city_id' => 'City',
            'callback_date' => 'Callback Date',
            // 'departure_city' => 'Departure City',
            // 'with_food' => 'Food',
            // 'with_visa' => 'Visa',
            // 'with_ticket' => 'Airline Ticket',
            'callback_time' => 'Callback Time',
            'address' => 'Address',
            'userInput' => 'Captcha',

        ];
    }

    // Save the feedback
    public function save()
    {
        // $validated = [];
        $validated = $this->validate();

        $validated['unique_id'] = Helper::generateUniqueId();
        // dd($validated);
        // try{
        // }catch(\Exception $e){
        //  dd($e->getMessage());
        // }
        // dd(123);
        // $validatedData = $this->validate();
        // dd($validatedData);
        // Generate a unique code for unique_id


        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;


        unset($validated['country_id']);
        unset($validated['city_id']);
        $validated['callback_country_id'] = $this->country_id;
        $validated['callback_city_id'] = $this->city_id;
        // dd($validatedData);

        if ($validated) {


            $callusback = CallUsBack::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new CallUsBackInquiryEmail($callusback, $randomStaff,$adminSetting, $adminwhatsapp));

            // Flash success message
            session()->flash('callus_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            $this->reset(); // Optionally, reset form fields
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
    // public function changeCountry()
    //     {
    //         $this->cities = City::where('country_id',$this->country_id)->pluck('city_name', 'id');
    //         $this->city_id = null;
    //         // dd($this->cities);
    //     }
    public function render()
    {
        return view('user.call-us-back-component');
    }
}
