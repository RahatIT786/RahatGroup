<?php

namespace App\Http\Controllers\Agent\Tool\MakeCustomize;

use App\Helpers\Helper;
use App\Models\Umrah;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Country;
use App\Models\City;
use App\Models\Staff;
use Illuminate\Support\Facades\Mail;
use App\Mail\UmrahPackageInquiryEmail;
use App\Models\AdminSetting;
use Illuminate\Support\Facades\Auth;

class MakeCustomizeListComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $nights_makkah, $country_id, $countries, $cities = [], $city_id, $nights_medina, $hotel_type, $adults, $sharing_type, $travel_date, $name, $email, $mobile, $nationality, $comments,  $children, $infants, $validated;

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
            // 'departure_city' => 'required',
            // 'with_food' => 'required',
            // 'with_visa' => 'required',
            // 'with_ticket' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10',
            'nationality' => 'required',
            'comments' => 'required',
            // 'userInput' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
        ], [], [
            'nights_makkah' => 'Nights in Makkah',
            'nights_medina' => 'Nights in Medina',
            'hotel_type' => 'Hotel Type',
            'adults' => 'Adults',
            'children' => 'Children',
            'infants' => 'Infants',
            'sharing_type' => 'Sharing Type',
            'travel_date' => 'Travel Date',
            // 'departure_city' => 'Departure City',
            // 'with_food' => 'Food',
            // 'with_visa' => 'Visa',
            // 'with_ticket' => 'Airline Ticket',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'nationality' => 'Nationality',
            'comments' => 'Comments',
            // 'userInput' => 'Captcha',
            'country_id' => 'Country',
            'city_id' => 'City',
        ]);


        $validated = [];
        try {
            $validated = $this->validate([
                'nights_makkah' => 'required',
                'nights_medina' => 'required',
                'hotel_type' => 'required',
                'adults' => 'required',
                'children' => 'required',
                'infants' => 'required',
                'sharing_type' => 'required',
                'travel_date' => 'required',
                // 'departure_city' => 'required',
                // 'with_food' => 'required',
                // 'with_visa' => 'required',
                // 'with_ticket' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|min:10',
                'nationality' => 'required',
                'comments' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
            ], [], []);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        $rmStaffId = Auth::user()->rm_staff_id;

        $agency = Staff::find($rmStaffId);
        $validated['support_team'] = $agency->id;
        $validated['status'] = 1;

        unset($validated['country_id']);
        unset($validated['city_id']);
        $validated['departure_country_id'] = $this->country_id;
        $validated['departure_city_id'] = $this->city_id;
        // Create Umrah record
        if ($validated) {
            $umrahInquiry = Umrah::create($validated);
            // Flash success message
            session()->flash('umrah_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $agency->first_name . ' ' . $agency->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $agency['mobile'] . '</strong><br> They will call you soon.');

            $this->reset(); // Optionally, reset form fields

            // Redirect to the customizedUmrah route (adjust according to your routes)
            return redirect()->route('agent.makeCustomize.index');
        }
    }

    public function mount()
    {
        // $this->generateCaptcha();
        $this->countries = Country::all()->pluck('countryname', 'id');
        $this->cities = City::all()->pluck('city_name', 'id');
    }

    public function changeCountry()
    {
        $this->cities = City::where('country_id', $this->country_id)->pluck('city_name', 'id');
        $this->city_id = null;
        // dd($this->cities);
    }


    // public function generateCaptcha()
    // {
    //     $text = Str::random(6); // Generate random text for CAPTCHA
    //     $image = imagecreatetruecolor(120, 40); // Create a blank image

    //     // Set colors
    //     $background_color = imagecolorallocate($image, 255, 255, 255); // White background
    //     $text_color = imagecolorallocate($image, 0, 0, 0); // Black text color

    //     // Fill image with background color
    //     imagefilledrectangle($image, 0, 0, 120, 40, $background_color);

    //     // Add random lines to make CAPTCHA harder to read for bots
    //     for ($i = 0; $i < 5; $i++) {
    //         imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $text_color);
    //     }

    //     // Add text to image
    //     imagettftext($image, 20, 0, 10, 30, $text_color, public_path('css/fonts/nunito-v9-latin-600.ttf'), $text);

    //     // Output the image as base64
    //     ob_start();
    //     imagepng($image);
    //     $this->captchaImage = base64_encode(ob_get_clean());
    //     imagedestroy($image);

    //     // Store CAPTCHA code in session
    //     session(['captcha_code' => $text]);
    // }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.make-customize.make-customize-list-component');
    }
}
