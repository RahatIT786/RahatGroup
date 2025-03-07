<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\City;
use App\Models\FlightMaster;
use App\Models\Staff;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketInquiryEmail;
use App\Models\TicketEnquiry;
use App\Models\AdminSetting;

class TicketViewModalComponent extends Component
{
    use WithFileUploads;

    public $city, $flight, $captchaImage;

    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $phone;

    #[Validate]
    public $travel_date;

    #[Validate]
    public $city_id;

    #[Validate]
    public $flight_id;

    #[Validate]
    public $adults;

    #[Validate]
    public $children;

    #[Validate]
    public $infants;

    #[Validate]
    public $message;

    #[Validate]
    public $userInput;

    public function mount()
    {
        $this->city = City::pluck('city_name', 'id');
        $this->flight = FlightMaster::pluck('flight_name', 'id');
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
        session(['ticket_Enquiry_captcha_code' => $text]);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'flight_id' => 'required',
            'city_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
            'travel_date' => 'required|date',
            'adults' => 'required',
            'children' => 'required',
            'infants' => 'required',
            'message' => 'required',
            'userInput' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'Name',
            'flight_id' => 'Airline',
            'city_id' => 'City',
            'email' => 'Email',
            'phone' => 'Mobile',
            'travel_date' => 'Date Of Travel',
            'adults' => 'Adult',
            'children' => 'Children',
            'infants' => 'Infants',
            'message' => 'Message',
            'userInput' => 'CAPTCHA',
        ];
    }

    public function save()
    {
        // dd($this->name, $this->phone, $this->infants);
        if ($this->userInput !== session('ticket_Enquiry_captcha_code')) {
            $this->addError('userInput', 'The CAPTCHA code is incorrect.');
            return;
        }
        $validated = $this->validate();

        // Generate a unique code for unique_id
        $validated['unique_id'] = Helper::generateUniqueId();

        // Choose a random staff ID and store it in support_team
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {
            $ticketenquiry = TicketEnquiry::create($validated);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new TicketInquiryEmail($ticketenquiry, $randomStaff));

            // Flash success message
            session()->flash('ticketenq_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');
            $this->reset(); // Optionally, reset form fields
            $this->generateCaptcha(); // Generate a new CAPTCHA
        }
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.ticket-view-modal-component');
    }
}
