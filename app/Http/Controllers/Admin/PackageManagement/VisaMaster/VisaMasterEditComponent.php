<?php

namespace App\Http\Controllers\Admin\PackageManagement\VisaMaster;

use App\Models\Country;
use App\Models\VisaDetails;
use App\Models\VisaCategory;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VisaMasterEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $country, $country_id, $visa_name, $visa, $visa_id, $entry_type, $visa_validity, $stay_period, $visatype;
    public $visaDetail = [];

    public $start_date;
    public $end_date;
    public $visa_price;

    public function mount($visacategory)
    {
        $this->visa = VisaCategory::whereId($visacategory)->with('visadetail')->first();
        $this->country = Country::pluck('countryname', 'id');

        if ($this->visa) {
            $this->visa_id = $this->visa->id;
            $this->country_id = $this->visa->countryid;
            $this->visa_name = $this->visa->visa_name;
            $visaDetails = VisaDetails::where('visa_id', $this->visa_id)->first();

            // Null check for VisaDetails
            if ($visaDetails) {
                $this->entry_type = $visaDetails->entry_type;
                $this->visa_validity = $visaDetails->visa_validity;
                $this->stay_period = $visaDetails->stay_period;
                $this->visa_price = $visaDetails->visa_price;
            }
        }
    }

    public function update()
    {
        $rules = [
            'country_id' => 'required',
            'visa_name' => 'required',
            'entry_type' => 'required',
            'visa_validity' => 'required',
            'stay_period' => 'required',
            'visa_price' => 'required|numeric',
        ];

        $customAttributes = [
            'country_id' => 'country name',
            'visa_name' => 'visa name',
            'entry_type' => 'entry type',
            'visa_validity' => 'visa validity',
            'stay_period' => 'stay period',
            'visa_price' => 'Visa Price',
        ];

        $validated = $this->validate($rules, [], $customAttributes);

        if ($this->visa_id) {
            $visaData = VisaCategory::find($this->visa_id);

            if (!$visaData) {
                $this->alert('error', 'Visa Category not found');
                return;
            }

            $visaData->update([
                'countryid' => $validated['country_id'],
                'visa_name' => $validated['visa_name'],
                'is_active' => 1,
            ]);

            $visaDetails = VisaDetails::where('visa_id', $this->visa_id)->first();

            if ($visaDetails) {
                $visaDetails->update([
                    'country_id' => $validated['country_id'],
                    'visa_id' => $visaData->id,
                    'entry_type' => $this->entry_type ?? '',  // Fallback if null
                    'visa_validity' => $this->visa_validity ?? '',
                    'stay_period' => $this->stay_period ?? '',
                    'visa_price' => $this->visa_price,
                    'is_active' => 1,
                ]);
            } else {
                VisaDetails::create([
                    'country_id' => $validated['country_id'],
                    'visa_id' => $visaData->id,
                    'entry_type' => $this->entry_type ?? '',
                    'visa_validity' => $this->visa_validity ?? '',
                    'stay_period' => $this->stay_period ?? '',
                    'visa_price' => $this->visa_price,
                    'is_active' => 1,
                ]);
            }
        }

        $this->alert('success', 'Visa Successfully Updated');
        return redirect()->route('admin.visaMaster.index');
    }

    public function render()
    {
        return view('admin.package-management.visa-master.visa-master-edit-component');
    }
}
