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

class StaffEditComponent extends Component
{
        public $role_id, $department_id, $country_id, $city_id, $photo, $first_name, $last_name, $email, $mobile, $detail, $office_no, $postal_code, $address, $staffrole, $staffroleId, $staffdepartment, $staffdepartmentId, $country, $countryId, $city, $cityId, $status, $id;
    use LivewireAlert;

    public function mount(StaffMaster $staff)
    {
        $this->id = $staff->id;
        $this->first_name = $staff->first_name;
        $this->last_name = $staff->last_name;
        $this->email = $staff->email;
        $this->mobile = $staff->mobile;
        $this->office_no = $staff->office_no;
        $this->detail = $staff->detail;
        $this->postal_code = $staff->postal_code;
        $this->address = $staff->address;
        $this->role_id = $staff->role_id;
        $this->department_id = $staff->department_id;
        $this->country_id = $staff->country_id;
        $this->city_id = $staff->city_id;
        $this->photo = $staff->photo;
        $this->status = $staff->is_active;
        // $this->staffroleId = optional($staff->staffrole)->id;
        $this->staffrole = StaffRoles::pluck('staff_role', 'id');
        // $this->staffdepartmentId = optional($staff->staffdepartment)->id;
        $this->staffdepartment = StaffDepartment::pluck('department_name', 'id');
        // $this->countryId = optional($staff->country)->id;
        $this->country = Country::pluck('countryname', 'id');
        // $this->cityId = optional($staff->city)->id;
        $this->city = City::pluck('city_name', 'id');
    }

    public function update()
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
        $validated['is_active'] = $this->status;
        StaffMaster::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.staff_update'));
        return to_route('admin.staff.index');
    }

    public function render()
    {
        return view('admin.staff.staff-edit-component');
    }
}
