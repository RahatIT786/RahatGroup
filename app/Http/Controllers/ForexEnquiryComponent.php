<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Models\ForexEnquiry;
use App\Models\Staff;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForexInquiryEmail;
use App\Models\AdminSetting;

class ForexEnquiryComponent extends Component
{
    use WithFileUploads;
    public $captchaImage;

    #[Validate]
    public $title;

    #[Validate]
    public $full_name;

    #[Validate]
    public $mob_num;

    #[Validate]
    public $email_id;

    #[Validate]
    public $currency_id;

    #[Validate]
    public $amount;

    #[Validate]
    public $delivery;

    #[Validate]
    public $address;

    #[Validate('required')]
    public $userInput;

    // Define validation rules

    public function rules()
    {

        return [
            'title' => 'required',
            'full_name' => 'required',
            'mob_num' => 'required|min:10|max:15',
            'email_id' => 'required',
            'currency_id' => 'required',
            'amount' => 'required',
            'delivery' => 'required',
            'address' => 'required',
        ];
    }


    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'title' => 'Title',
            'full_name' => 'Full Name',
            'mob_num' => 'Contact Number',
            'email_id' => 'Email',
            'currency_id' => 'Category',
            'amount' => 'Amount',
            'delivery' => 'Delivery',
            'address' => 'Address',


        ];
    }

    public function mount()
    {
        $this->title = 1;
        $this->currency_id = 1;
        $this->delivery = 1;
        $this->generateCaptcha();
    }

    // Save the feedback
    public function save()
    {
        // dd(134);
        // Validate the data
        $validatedData = $this->validate();
        // dd($validatedData);

        // Generate a unique code for unique_id
        $validatedData['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validatedData['support_team'] = $randomStaff->id;
        $validatedData['status'] = 1;

        if ($validatedData) {
            // Create a new feedback record
            $forexenquiry = ForexEnquiry::create($validatedData);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new ForexInquiryEmail($forexenquiry, $randomStaff));

            // Flash success message
            session()->flash('forex_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validatedData['unique_id']) . '</strong>' .
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




    public function render()
    {
        return view('user.forex-enquiry-component');
    }
}
