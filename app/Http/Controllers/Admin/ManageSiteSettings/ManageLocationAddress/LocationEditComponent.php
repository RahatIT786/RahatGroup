<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageLocationAddress;

use Livewire\Component;

use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LocationEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $country_id,$city_id,$address,$phone_no,$tollfree_no,$email,$map_address,$country,$city,$locationId;

    public function mount(Location $location)
    {
        // dd($location);
        $this->is_edit = true;
        $this->locationId = $location->id;
        $this->country_id = $location->country_id;
        $this->city_id = $location->city_id;
        $this->address = $location->address;
        $this->phone_no = $location->phone_no;
        $this->tollfree_no = $location->tollfree_no;
        $this->email = $location->email;
        $this->map_address = $location->map_address;

        $this->country = Country::pluck('countryname', 'id');
        $this->city = City::pluck('city_name', 'id');
// dd($this->country);
    }
    public function update()
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
        // $validated['map_address'] = $this->map_address;

        Location::whereId($this->locationId)->update($validated);


        $this->alert('success', Lang::get('messages.location_update', [
            'timer' => 7000,
        ]));
        return to_route('admin.location.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-location-address.location-edit-component');
    }
}
