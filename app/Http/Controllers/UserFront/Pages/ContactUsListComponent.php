<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Contact;
use App\Models\Location;
use Illuminate\Support\Str;

class ContactUsListComponent extends Component
{
    public $fname,$lname,$email, $phone, $message, $captchaImage,$contacts,$salutation;
    public $userInput;

    public function mount()
    {
        $this->contacts =  Location::with('city')->get();
        // dd($this->contacts);
        $this->generateCaptcha();
    }

    public function save()
    {
        // dd(123);
        $rules = [
            'salutation'=> 'required',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'message' => 'required|string',
            'userInput' => 'required',
        ];

        $validationAttributes = [
            'userInput' => 'captcha',
            'phone' => 'mobile',
        ];

        $validated = $this->validate($rules, [], $validationAttributes);


    // Check CAPTCHA
    if ($this->userInput !== session('captcha_code')) {
        $this->addError('userInput', 'Invalid CAPTCHA code.');
        return;
    }

    $this->resetErrorBag('userInput');

    // Concatenate first name and last name
    $fullName = $this->fname . ' ' . $this->lname;

    // Save form data with the merged name
    Contact::create([

        'name' => $fullName,
        'email' => $this->email,
        'salutation'=> $this->salutation,
        'phone' => $this->phone,
        'message' => $this->message,
    ]);

    // Reset form fields
    $this->reset(['fname', 'lname','salutation' ,'email', 'phone', 'message', 'userInput']);

    // Flash success message and redirect
    session()->flash('success', 'Your message has been submitted successfully.');
    return redirect()->route('customer.ContactUs');
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
        // dd($this->captchaImage);
        imagedestroy($image);
        // dd($text);
        // // Store CAPTCHA code in session
        session(['captcha_code' => $text]);
        // dd($this->captchaImage);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.contact-us-list-component');
    }
}
