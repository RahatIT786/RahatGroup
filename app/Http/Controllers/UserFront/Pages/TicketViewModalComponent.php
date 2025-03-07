<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\Bookingenquiry;
use App\Models\AdminSetting;
use App\Models\City;
use App\Models\FlightMaster;
use App\Models\Staff;
use App\Models\Pnr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketInquiryEmail;
use App\Models\TicketEnquiry;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Request;

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

    protected $listeners = ['putInData'];
    public $pnrCode,$flightName,$departureName,$returnsectorName,$deptDate,$returnDate,$deptTime,$returnTime,$adultCost,$childCost,$infantCost,$avaiSeats;

public $search_city,$cities,$flights,$city_name;
    public function mount()
    {
        $this->cities = City::all(); // Ensure $cities is always an array of cities
    $this->search_city = Request::query('dept_city_id');

        $this->flight = FlightMaster::pluck('flight_name', 'id')->toArray();
        $this->generateCaptcha();
        $this->pnrCode = Pnr::first()->pnr_code;
        // $this->flights = FlightMaster::all()->pluck('flight_name', 'id');
    }

    #[On('ticket-details')]
    public function example($pnr_id)
    {
    //    dd($pnr_id);
    //    $this->pnrCode = "pnr_code";
    $pnr = Pnr::find($pnr_id);
    // if ($pnr) {
    //     $this->pnrCode = $pnr->pnr_code;
    if ($pnr) {
        $this->pnrCode = $pnr->pnr_code;  // Set pnr_code
        $this->flight_id = $pnr->flight_id; // Pre-fill flight ID
        $this->flightName = $pnr->flight ? $pnr->flight->flight_name : 'N/A';
        $this->departureName = $pnr->departuresector ? $pnr->departuresector->sector_name : 'N/A';
        $this->returnsectorName = $pnr->returnsector ? $pnr->returnsector->sector_name : 'N/A';
        $this->deptDate = $pnr->dept_date;
        $this->returnDate = $pnr->return_date;
        $this->deptTime = $pnr->dept_time;
        $this->returnTime = $pnr->return_time;
        $this->adultCost = $pnr->adult_cost;
        $this->childCost = $pnr->child_cost;
        $this->infantCost = $pnr->infant_cost;
        $this->avaiSeats = $pnr->avai_seats;
        $this->city_id = $pnr->city ? $pnr->city->id : null;
        $this->city_name = $pnr->city ? $pnr->city->city_name : 'N/A';

    } else {
        $this->pnrCode = 'N/A';
        $this->flightName = 'N/A';
        $this->departureName = 'N/A';
        $this->returnsectorName = 'N/A';
        $this->deptDate = 'N/A';
        $this->returnDate = 'N/A';
        $this->deptTime = 'N/A';
        $this->returnTime = 'N/A';
        $this->adultCost = 'N/A';
        $this->childCost = 'N/A';
        $this->infantCost  = 'N/A';
        $this->avaiSeats = 'N/A';
        $this->flight_id = null;
        $this->city_id = null;
        $this->city_name = 'N/A';
    }


    }

    public function changeInput()
    {
       //
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
        // if ($this->userInput !== session('ticket_enquiry')) {
        //     $this->addError('userInput', 'The CAPTCHA code is incorrect.');
        //     return;
        // }

        $validated = $this->validate();

        $validated['unique_id'] = Helper::generateUniqueId();
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        if ($validated) {
            $ticketenquiry = TicketEnquiry::create($validated);
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

            Mail::to($randomStaff->email)->cc($adminEmail)->send(new TicketInquiryEmail($ticketenquiry, $randomStaff,$adminSetting, $adminwhatsapp));
            session()->flash('customer_ticket', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');
            $this->reset(); // Optionally, reset form fields
            $this->generateCaptcha(); // Generate a new CAPTCHA

        }
    }
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.ticket-view-modal-component');
    }
}
