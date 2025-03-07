<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Staff;
use App\Helpers\Helper;
use App\Models\KitCategory;
use App\Models\HajjKitEnquiry;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\HajjKitEnquiryEmail;
use App\Models\AdminSetting;

class HajjKitEnquiryComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public  $captchaImage;
    public $kitName;
    public $kit;
    public $kitId;


    #[Validate('required|string')]
    public $delivery_date;
    #[Validate('required|string')]
    public $name;
    #[Validate('required|email')]
    public $email;
    #[Validate('required|digits:10')]
    public $mobile_num;
    #[Validate('required|string')]
    public $address;
    #[Validate('required|string')]
    public $description;
    #[Validate('required')]
    public $userInput;

    public function mount($slug)
    {
        // dd($slug);
        $this->generateCaptcha();
        // dd($this->generateCaptcha());
        $this->kit = KitCategory::where('slug', $slug)->first();
        // $this->kitcategory = KitCategory::pluck('name', 'id');
        // dd($this->kit);
        $this->kitId = $this->kit->id;
        // dd($this->kitId);

        if (!$this->kit) {
            $this->kitName = 'Kit Name Not Found';
        } else {
            $this->kitName = $this->kit->name;
        }
    }

    public function validationAttributes()
    {
        return [
            'delivery_date' => 'Delivery Date',
            'name' => 'Name',
            'email' => 'Email Address',
            'mobile_num' => 'Mobile Number',
            'address' => 'Address',
            'description' => 'Descriptions',
            'userInput' => 'Captcha',
        ];
    }

    public function save()
    {
        // dd('hi');
        $validated = $this->validate();
        // dd($validated);

        $validated['unique_id'] = Helper::generateUniqueId();

        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;
        $validated['kit_id'] =   $this->kitId;


        if ($validated) {
            $hajjkitEnquiry =
                HajjKitEnquiry::create($validated);
                $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
                $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
                $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
                $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            // // dd($validated);
            Mail::to($randomStaff->email)->cc($adminEmail)->send(new HajjKitEnquiryEmail($hajjkitEnquiry, $randomStaff, $adminSetting, $adminwhatsapp));

            session()->flash('enquiry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query. Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');
            // $this->dispatch('reload-page');
            $this->reset();
            $this->generateCaptcha();
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
        return view('user.pages.hajj-kit-enquiry-component');
    }
}
