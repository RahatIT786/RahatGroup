<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\TouristVisa;

use App\Models\TouristVisa;
use App\Models\Country;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TouristVisaEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $id,$visa_type, $cust_name, $cust_email, $cust_mob, $cust_nationality, $support_team, $country, $country_id;

    public function mount(TouristVisa $touristVisa)
    {
        // dd($touristVisa);
        $this->id = $touristVisa->id;
        $this->country_id = $touristVisa->country_id;
        $this->visa_type = $touristVisa->visa_type;
        $this->cust_name = $touristVisa->cust_name;
        $this->cust_email = $touristVisa->cust_email;
        $this->cust_mob = $touristVisa->cust_mob;
        $this->cust_nationality = $touristVisa->cust_nationality;
        $this->support_team = $touristVisa->support_team;
        
        $this->country = Country::pluck('countryname', 'id');
        // dd($this->country);
    }  

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
           
        ]);
        TouristVisa::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.tourist_visa_update'));
        return to_route('admin.touristVisa.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.tourist-visa.tourist-visa-edit-component');
    }
}
