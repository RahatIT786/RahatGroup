<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress;

use Livewire\Component;
use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class LocationCreateComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10,$country_id,$city_id,$address,$phone_no,$tollfree_no,$email,$map_address,$country,$city;

    public function save()
    {
        $validated = $this->validate([
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'tollfree_no' => 'required',
            'email' => 'required',
           'map_address' => 'required',

        ], [], [

            'country_id' => 'Country Name',
            'city_id' => 'City Name',
            'address' => 'address',
            'phone_no' => 'phone_no',
            'tollfree_no' => 'tollfree_no',
            'email' => 'email',
           'map_address' => 'map_address',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        Location::create($validated);
        $this->alert('success', Lang::get('messages.location_save'));
        $this->dispatch('close-modal', modal: 'crudModal');
        return redirect()->route('admin.location.index');
    }
    // $this->alert('success', Lang::get('messages.award_save'));

    // return redirect()->route('admin.award.index');

    public function mount()
    {
        $this->country = Country::pluck('countryname', 'id');
        $this->city = City::pluck('city_name', 'id');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-location-address.location-create-component');
    }
}
