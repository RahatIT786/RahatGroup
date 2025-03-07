<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\City;
use App\Models\Country;
use App\Models\StaffDepartment;
use App\Models\StaffMaster;
use App\Models\StaffRoles;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class StaffCreateComponent extends Component
{
    public $staffrole, $staffroleId, $staffdepartment, $staffdepartmentId, $country, $countryId, $city, $cityId;
    use LivewireAlert;

    public function save()
    {
        $validated = $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'role_id' => 'required',
            'department_id' => 'required',
            'office_no' => 'required',
            'detail' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'photo' => 'required',
            'address' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        // dd($validated);
        StaffMaster::create($validated);
        $this->alert('success', Lang::get('messages.staff_create'));
        return to_route('admin.staff.index');
    }

    public function mount()
    {
        $this->staffrole = StaffRoles::pluck('staff_role', 'id');
        $this->staffdepartment = StaffDepartment::pluck('department_name', 'id');
        $this->country = Country::pluck('countryname', 'id');
        $this->city = City::pluck('city_name', 'id');
        // dd($this->districts);
    }

    public function render()
    {
        return view('admin.staff.staff-create-component');
    }
}
