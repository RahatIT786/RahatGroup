<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Livewire\Attributes\Validate;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\CallUsBackInquiryEmail;
use App\Models\ShoppingEnquiry;

class ShoppingEnquiryModalComponent extends Component
{
    use LivewireAlert, WithFileUploads;

public $captchaImage;
#[Validate('required')]
public $name;
#[Validate('required')]
public $email;
#[Validate('required')]
public $mobile;
#[Validate('required')]
public $delivery_date;
#[Validate('required')]
public $address;
#[Validate('required')]
public $description;
#[Validate('required')]
public $userInput;


public function mount()
{
    $this->generateCaptcha();
}


// Define custom attribute names for validation messages
public function validationAttributes()
{
    return [
        'name' => 'Name',
        'email' => 'Email',
        'mobile' => 'Mobile Number',
        'delivery_date' => 'Callback Date',
        'address' => 'Address',
        'description' => 'Description',
        'userInput' => 'Captcha',
    ];
}

// Save the feedback
public function save()
{
    // $validated = [];
    $validated = $this->validate();

    if ($this->userInput !== session('shopping_captcha_code')) {
        $this->addError('userInput', 'Invalid CAPTCHA code.');
        return;
    }
    $this->resetErrorBag('userInput');
    // Generate a unique code for unique_id
    $validated['unique_id'] = Helper::generateUniqueId();

    // Choose a random staff ID and store it in support_team
    $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
    $validated['support_team'] = $randomStaff->id;
    $validated['status'] = 1;


    // if ($validated) {

    ShoppingEnquiry::create($validated);
        // Mail::to($randomStaff->email)->cc('joddhajitputel143@gmail.com')->send(new PublicationInquiryEmail($publicationData, $randomStaff));

        // Flash success message
        session()->flash('publication_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
            ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
            ' has been assigned this query.<br> They will call you soon.');

        $this->dispatch('reload-page');
        // $this->reset(); // Optionally, reset form fields
    // }
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
    session(['shopping_captcha_code' => $text]);
    // dd($this->captchaImage);
}

    public function render()
    {
        return view('user.shopping-enquiry-modal-component');
    }
}
