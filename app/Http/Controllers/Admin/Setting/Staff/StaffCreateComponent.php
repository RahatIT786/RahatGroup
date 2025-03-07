<?php

namespace App\Http\Controllers\Admin\Setting\Staff;

use App\Models\City;
use App\Models\Country;
use App\Models\StaffDepartment;
use App\Models\Staff;
use App\Models\StaffRoles;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $staffrole, $staffroleId, $staffdepartment, $staffdepartmentId, $country, $countryId, $city, $cityId;
    public $first_name, $last_name, $email, $mobile, $role_id, $department_id, $office_no, $detail, $country_id, $city_id, $postal_code, $photo, $address, $salary, $password;

    public function mount()
    {
        $this->staffrole = StaffRoles::pluck('staff_role', 'id');
        $this->staffdepartment = StaffDepartment::pluck('department_name', 'id');
        $this->country = Country::pluck('countryname', 'id');
        $this->city = City::pluck('city_name', 'id');
    }

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
            'photo' => 'required|image|max:1024',
            'address' => 'required',
            'salary' => 'required',
            'password' => 'required',
        ], [], [
            'first_name' => 'staff first name',
            'last_name' => 'staff last name',
            'role_id' => 'role',
            'department_id' => 'department',
            'country_id' => 'country',
            'city_id' => 'city',
            'photo' => 'profile image',
        ]);
        // dd($validated);
        $uuid = Str::uuid();
        $imageExtension = $validated['photo']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;

        // Store the profile image in the storage/app/public directory
        Storage::putFileAs('public/staff_photo', $validated['photo'], $imageName);

        $validated['photo'] = $imageName;

        $validated['password'] = Hash::make($validated['password']);
        // dd($validated);
        Staff::create($validated);
        $this->alert('success', Lang::get('messages.staff_save'));
        return to_route('admin.staff.index');
    }

    public function render()
    {
        return view('admin.setting.staff.staff-create-component');
    }
}
