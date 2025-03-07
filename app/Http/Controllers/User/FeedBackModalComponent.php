<?php

namespace App\Http\Controllers\User;

use App\Models\FeedBack;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Helpers\Helper;

class FeedBackModalComponent extends Component
{
    use WithFileUploads;
    public $captchaImage;

    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $cust_num;

    #[Validate]
    public $cust_msg;

    #[Validate]
    public $feedback_cat;

    #[Validate('required')]
    public $userInput;

    // Define validation rules
    public function mount()
    {
        $this->generateCaptcha();
        // dd($this->generateCaptcha());
    }
    public function rules()
    {
        return [
            'cust_name' => 'required',
            'cust_email' => 'required|email',
            'cust_num' => 'required|min:10|max:10',
            'cust_msg' => 'required',
            'feedback_cat' => 'required',
            'userInput' => 'required',
        ];
    }


    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'cust_name' => 'Name',
            'cust_email' => 'Email',
            'cust_num' => 'Contact Number',
            'cust_msg' => 'Message',
            'feedback_cat' => 'Category',
            'userInput' => 'Captcha',
        ];
    }

    // Save the feedback
    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();
        $validated['unique_id'] = Helper::generateUniqueId();
        // Create a new feedback record
        FeedBack::create($validatedData);
        // $this->dispatch('reload-page');
        // Set a flash message and reset the form
        session()->flash('feed_success', 'Feedback successfully submitted.');
        $this->reset(); // Optionally, reset form fields
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
        return view('user.feed-back-modal-component');
    }
}
