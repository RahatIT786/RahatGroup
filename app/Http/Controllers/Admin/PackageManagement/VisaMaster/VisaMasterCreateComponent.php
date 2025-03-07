<?php

namespace App\Http\Controllers\Admin\PackageManagement\VisaMaster;

use App\Models\Country;
use App\Models\VisaDetails;
use App\Models\VisaCategory;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VisaMasterCreateComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $country, $country_id,$visa_name, $visa_id, $entry_type, $visa_validity, $stay_period ,$visatype;
    public $visaDetail = [];

    public $start_date;
    public $end_date;
    public $visa_price;

    public function save()
    {
        
        // Basic validation rules
        $rules = [
            'country_id' => 'required',
            'visa_name' => 'required',
            'entry_type' => 'required',
            'visa_validity' => 'required',
            'stay_period' => 'required',
            'visa_price' => 'required',
        ];
        // Custom attribute names
        $customAttributes = [
            'country_id' => 'country name',
            'visa_name' => 'visa name',
            'entry_type' => 'entry type',
            'visa_validity' => 'visa validity',
            'stay_period' => 'stay period',
            'visa_price' => 'Visa Price',
        ];

        // Validate the request
        $validated = $this->validate($rules, [], $customAttributes);
        
        // Create VisaCategory
        $visaData = VisaCategory::create([
            'countryid' => $validated['country_id'],
            'visa_name' => $validated['visa_name'],
            'is_active' => 1,
        ]);
        // dd(
        // $validated['country_id'],
        // $visaData->id,
        // $this->entry_type,
        // $this->visa_validity,
        // $this->stay_period,
        // $this->visa_price);
        // Create VisaDetails
            VisaDetails::create([
                'country_id' => $validated['country_id'],
                'visa_id' => $visaData->id,
                'entry_type' => $this->entry_type,
                'visa_validity' => $this->visa_validity,
                'stay_period' => $this->stay_period,
                'visa_price' => $this->visa_price,
                'is_active' => 1,
            ]);

        // Alert success and redirect
        $this->alert('success', 'Visa Successfully Added');
        return redirect()->route('admin.visaMaster.index');
    }


    public function mount()
    {
        $this->country = Country::pluck('countryname', 'id');
    }

    public function render()
    {
        return view('admin.package-management.visa-master.visa-master-create-component');
    }
}
