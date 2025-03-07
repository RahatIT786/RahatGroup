<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use App\Models\Laundry;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaundryEnquiryEmail;
use App\Models\AdminSetting;

class LaundryListComponent extends Component
{
    use WithFileUploads;
    public $captchaImage;

    #[Validate]
    public $no_of_guest;

    #[Validate]
    public $booking_date;

    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $mobile;

    #[Validate]
    public $whatsapp;

    #[Validate]
    public $hotel_name;

    #[Validate]
    public $comments;

    #[Validate('required')]
    public $userInput;

    // Define validation rules

    public function rules()
    {

        return [
            'booking_date' => 'required',
            'no_of_guest' => 'required',
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|min:10|max:15',
            'whatsapp' => 'required',
            'hotel_name' => 'required',
            'comments' => 'required',
            // 'address' => 'required',
        ];
    }

    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'booking_date'  => 'Booking date',
            'no_of_guest' => 'No Of Guest',
            'name' => ' Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'whatsapp' => 'Whatsapp',
            'hotel_name' => 'Hotel Name',
            'comments' => 'Comments',
            // 'address' => 'Address',

        ];
    }

    public function mount()
    {
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


            // Create a new feedback record
        //   Laundry::create($validatedData);

          if ($validatedData) {
            // Umrah::create($validated);
            $laundryenquiry = Laundry::create($validatedData);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new LaundryEnquiryEmail($laundryenquiry, $randomStaff));


            // Flash success message
            session()->flash('laundry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validatedData['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            // $this->dispatch('reload-page');
            // $this->reset(); // Optionally, reset form fields

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


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.laundry-list-component');
    }
}
