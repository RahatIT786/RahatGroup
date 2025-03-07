<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Mail\QuickInquiryEmail;
use App\Models\Enquiry;
use App\Models\Staff;
use App\Models\AdminSetting;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class EnquiryModalComponent extends Component
{
    public $cat_id, $name, $email, $mobile_num, $whatsapp_num, $city_name, $captchaImage;
    public $userInput;

    public function mount()
    {
        $this->generateCaptcha();
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
        session(['enq_captcha_code' => $text]);
    }

    public function save()
    {
        // Check if the CAPTCHA code matches
        if ($this->userInput !== session('enq_captcha_code')) {
            $this->addError('userInput', 'The CAPTCHA code is incorrect.');
            return;
        }

        // Validate the input fields
        $validated = $this->validate([
            'cat_id' => 'required',
            'name' => 'required|max:50',
            'city_name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'mobile_num' => 'required|digits:10',
            'whatsapp_num' => 'required|digits:10',
            'userInput' => 'required',
        ], [], [
            'cat_id' => 'category',
            'city_name' => 'city',
            'mobile_num' => 'mobile',
            'whatsapp_num' => 'whatsapp',
            'userInput' => 'CAPTCHA',
        ]);

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;

        // Set the status to 1
        $validated['status'] = 1;

        // Store all validated data in the Enquiry model
        Enquiry::create($validated);

        if ($validated) {

            $quickEnquiry = Enquiry::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

            mail::to($randomStaff->email)->cc($adminEmail)->send(new QuickInquiryEmail($quickEnquiry, $randomStaff,$adminSetting, $adminwhatsapp));

            // Flash success message
            session()->flash('enquiry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            $this->reset();

            // Regenerate the CAPTCHA for the next submission
            $this->generateCaptcha();
        }
    }

    public function getEnquiry()
    {
        // return Enquiry::query()->active()->take(3)->get();
        return Enquiry::query()->take(3)->get();
    }

    public function render()
    {
        return view('user.enquiry-modal-component', [
            'QsEnquirys' => $this->getEnquiry()
        ]);
    }
}
