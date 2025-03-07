<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\Agent\Umrah;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;


class CustomizedUmrahComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $nights_makkah,$nights_medina,$hotel_type,$adults,$sharing_type,$travel_date,$departure_city,$with_food,$with_visa,$with_ticket,$name,$email,$mobile,$nationality,$comments,$captchaImage,$children,$infants,$validated,$userInput;
    
    public function save()
{
    $validated = $this->validate([
        'nights_makkah' => 'required',
        'nights_medina' => 'required',
        'hotel_type' => 'required',
        'adults' => 'required',
        'children' => 'required',
        'infants' => 'required',
        'sharing_type' => 'required',
        'travel_date' => 'required',
        'departure_city' => 'required',
        'with_food' => 'required',
        'with_visa' => 'required',
        'with_ticket' => 'required',
        'name' => 'required',
        'email' => 'required|email',
        'mobile' => 'required|min:10',
        'nationality' => 'required',
        'comments' => 'required',
        'userInput'=>'required',
    ], [], [
        'nights_makkah' => 'Nights in Makkah',
        'nights_medina' => 'Nights in Medina',
        'hotel_type' => 'Hotel Type',
        'adults' => 'Adults',
        'children' => 'Children',
        'infants' => 'Infants',
        'sharing_type' => 'Sharing Type',
        'travel_date' => 'Travel Date',
        'departure_city' => 'Departure City',
        'with_food' => 'Food',
        'with_visa' => 'Visa',
        'with_ticket' => 'Airline Ticket',
        'name' => 'Name',
        'email' => 'Email',
        'mobile' => 'Mobile',
        'nationality' => 'Nationality',
        'comments' => 'Comments',
        'userInput'=>'captcha',
    ]);


        $validated = [];
       try{
        $validated = $this->validate([
            'nights_makkah' => 'required',
            'nights_medina' => 'required',
            'hotel_type' => 'required',
            'adults' => 'required',
            'children'=>'required',
            'infants'=>'required',
            'sharing_type' => 'required',
            'travel_date' => 'required',
            'departure_city' => 'required',
            'with_food' => 'required',
            'with_visa' => 'required',
            'with_ticket' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10',
            'nationality' => 'required',
            'comments' => 'required',
        ], [], [
            
        ]);
       }catch(\Exception $e){
        // dd($e->getMessage());
       }

        // dd($validated);
        // Create Umrah record
        if ($validated) {
        Umrah::create($validated);
       
    
        // Flash success message
        $this->alert('success', Lang::get('messages.customizedumrah_save'));
    
        // Redirect to the customizedUmrah route (adjust according to your routes)
        return redirect()->route('customizedUmrah');
    }
}

public function mount()
{
    $this->generateCaptcha();
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
        return view('user.pages.customized-umrah-component');
    }
}
