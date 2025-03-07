<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;

use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use App\Models\Country;
use App\Models\HotelEnquiries;
use App\Models\HotelMaster;
use App\Models\Staff;
use App\Models\AdminSetting;
use App\Mail\CustomerHotelInquiryMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HotelDetailComponent extends Component
{
    public $hotel, $country;
    public $cust_name, $country_id, $mob_num, $message, $userInput, $captchaImage;


    public function mount($id)
    {
        $this->hotel = HotelMaster::with('hotelimage')->where('id', $id)->first();
        $this->country = Country::pluck('countryname', 'id');
        $this->generateCaptcha();
    }
    public function save()
    {
        $rules = [
            'cust_name' => 'required',
            'country_id' => 'required',
            'mob_num' => 'required|numeric|digits_between:10,20',
            'message' => 'required',
            'userInput' => 'required',
        ];

        $validationAttributes = [
            'country_id' => 'country',
            'mob_num' => 'mobile',
            'userInput' => 'Captcha',
        ];

        // Validate the input
        $validated = $this->validate($rules, [], $validationAttributes);

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();

        // Check if a staff member was found
        if (!$randomStaff) {
            session()->flash('error', 'No support staff available at the moment.');
            return;
        }

        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        // Create the hotel enquiry
        $hotelenquiry = HotelEnquiries::create([
            'hotel_id' => $this->hotel->id, // Assuming you need to store hotel_id in HotelEnquiries
            'cust_name' => $validated['cust_name'],
            'country_id' => $validated['country_id'],
            'mob_num' => $validated['mob_num'],
            'message' => $validated['message'],
            'unique_id' => $validated['unique_id'],
            'support_team' => $validated['support_team'],
            'status' => $validated['status'],
        ]);

        // Send email to the random staff member
        $adminSetting = AdminSetting::where('id', 1)->value('parameter_value');
        $adminwhatsapp = AdminSetting::where('id', 2)->value('parameter_value');
        $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
        $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

        Mail::to($randomStaff->email)->cc($adminEmail)->send(new CustomerHotelInquiryMail($hotelenquiry, $randomStaff, $adminSetting, $adminwhatsapp));

        // Flash success message
        session()->flash('hotel_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
            ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
            ' has been assigned this query.<strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

        // Clear form inputs after successful submission
        $this->reset(['cust_name', 'country_id', 'mob_num', 'message']);
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
        return view('user-front.pages.hotel-detail-component');
    }
}
