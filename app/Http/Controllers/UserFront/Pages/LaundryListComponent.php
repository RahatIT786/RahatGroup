<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use App\Helpers\Helper;
use App\Models\Laundry;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Staff;
use App\Mail\LaundryEnquiryEmail;

class LaundryListComponent extends Component
{
    use WithFileUploads;

    public $captchaImage;
    public $no_of_guest;
    public $booking_date;
    public $name;
    public $email;
    public $mobile;
    public $whatsapp;
    public $hotel_name;
    public $comments;
    public $userInput;

    public function rules()
    {
        return [
            'booking_date' => 'required',
            'no_of_guest' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|max:15',
            'whatsapp' => 'required',
            'hotel_name' => 'required',
            'comments' => 'required',
            'userInput' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->generateCaptcha();
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['unique_id'] = Helper::generateUniqueId();
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validatedData['support_team'] = $randomStaff->id;
        $validatedData['status'] = 1;

        if ($validatedData) {
            $laundryenquiry = Laundry::create($validatedData);
            Mail::to($randomStaff->email)->cc('n.sanghamitra@gmail.com')->send(new LaundryEnquiryEmail($laundryenquiry, $randomStaff));

            session()->flash('laundry_success', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validatedData['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query Mobile : <strong style="color: blue;">' . $randomStaff['mobile'] . '</strong><br> They will call you soon.');

            $this->dispatch('reload-page');
            $this->reset();
        }
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
        session(['captcha_code' => $text]);
    }
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.laundry-list-component');
    }
}
