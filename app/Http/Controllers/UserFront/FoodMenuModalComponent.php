<?php

namespace App\Http\Controllers\UserFront;

use App\Helpers\Helper;
use App\Models\FoodEnquiry;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Livewire\Attributes\Validate;
class FoodMenuModalComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public  $captchaImage;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $mobile;
    #[Validate('required')]
    public $madinah_hotel;
    #[Validate('required')]
    public $adults;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $children;
    #[Validate('required')]
    public $infants;
    #[Validate('required')]
    public $makkah_hotel;
    #[Validate('required')]
    public $travel_date;
    #[Validate('required')]
    public $userInput;


    public function mount()
    {

        $this->generateCaptcha();

        // dd($this->generateCaptcha());
    }


    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'name' => 'Name',
            'travel_date' => 'travel date',
            // 'l_name' => 'Last Name',
            'mobile' => 'Mobile Number',
            'email' => 'Email',
            'madinah_hotel' => 'Madinah Hotel',
            'adults' => 'Adults',
            'children' => 'Children',
            'infants' => 'Infants',
            // 'departure_city' => 'Departure City',
            // 'with_food' => 'Food',
            // 'with_visa' => 'Visa',
            // 'with_ticket' => 'Airline Ticket',
            'makkah_hotel' => 'Makka Hotel',
            'address' => 'Address',
            'unique_id' => 'Captcha',

        ];
    }

    // Save the feedback
    public function save()
    {
        // $validated = [];
        $validated = $this->validate();
        $validated['unique_id'] = Helper::generateUniqueId();


        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {

            $foodenquiry = FoodEnquiry::create($validated);
            session()->flash('foodenquiry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
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
        return view('user-front.food-menu-modal-component');
    }
}
