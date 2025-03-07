<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\PayNow;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Country;
use Livewire\Attributes\Validate;

class PayNowListComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public  $countries=[];

    #[Validate('required')]
    public $full_name;
    #[Validate('required')]
    public $mob_num;
    #[Validate('required')]
    public $email;
    #[Validate('required')]
    public $invoice_num;
    #[Validate('required')]
    public $currency_type;
    #[Validate('required')]
    public $amount;
    #[Validate('required')]
    public $city;
    #[Validate('required')]
    public $pincode;
    #[Validate('required')]
    public $country_id;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $additional_notes;

    #[Validate('required')]
    public $company_name;

    public function mount()
    {

        $this->currency_type = 1;
        $this->countries = Country::all()->pluck('countryname', 'id');
        // $this->cities = City::all()->pluck('city_name', 'id');
        // dd($this->cities);
    }

    public function validationAttributes()
{
    return [

        'full_name' => 'Full Name',
        // 'l_name' => 'Last Name',
        'mob_num' => 'Mobile Number',
        'email' => 'Email',
        'invoice_num' => 'Invoice Number',
        'currency_type' => 'Currency Type',
        'amount' => 'Amount',
        'company_name' => 'Company Name',
        'city'=>'City',
        'pincode'=>'pincode',
        'country_id'=>'country',
        'address' => 'Address',
        'additional_notes' => 'Additional Notes',

    ];
}

public function save()
{
//   dd("123");
    // $validated = [];
    // $validated = [];
    try{
        $validated = $this->validate();
    }catch(\Exception $e){
    //  dd($e->getMessage());
    }

    $validated = $this->validate();

    // dd($validated);
    // try{
    // }catch(\Exception $e){
    //  dd($e->getMessage());
    // }
    // dd(123);
    // $validatedData = $this->validate();
    // dd($validatedData);
    unset($validated['country_id']);
    $validated['country_id'] = $this->country_id;
// dd($validatedData);
PayNow::create($validated);
    $this->dispatch('reload-page');
    session()->flash('success', 'Pay now  successfully submitted.');
    $this->reset();
}

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.pay-now-list-component');
    }
}
