<?php

namespace App\Http\Controllers\Staff\Profile;

use App\Models\City;
use App\Models\Country;
use App\Models\Staff;
use App\Models\StaffDepartment;
use App\Models\StaffRoles;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $isUploaded = false;
    public $staffrole, $staffroleId, $staffdepartment, $staffdepartmentId, $country, $countryId, $city, $cityId, $status, $id, $photoEdit;
    public $first_name, $last_name, $email, $mobile, $role_id, $department_id, $office_no, $detail, $country_id, $city_id, $postal_code, $photo, $address, $salary, $password;
    public function mount(Staff $staff)
    {
        // dd($staff);
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
        $this->salary = $staff->salary;
        $this->department_id = $staff->department_id;
        $this->country_id = $staff->country_id;
        $this->city_id = $staff->city_id;
        $this->photoEdit = $staff->photo;
        $this->status = $staff->is_active;
        $this->staffrole = StaffRoles::pluck('staff_role', 'id');
        $this->staffdepartment = StaffDepartment::pluck('department_name', 'id');
        $this->country = Country::pluck('countryname', 'id');
        $this->city = City::pluck('city_name', 'id');
    }


    public function update()
    {
        // Prepare validation rules
        $rules = [
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email' => 'required|email',
            'mobile' => 'required|string|max:200',
            'role_id' => 'required|exists:aihut_staff_role,id',
            'department_id' => 'required|exists:aihut_department,id',
            'office_no' => 'required|string|max:200',
            'detail' => 'required|string',
            'country_id' => 'required|exists:aihut_country,id',
            'city_id' => 'required|exists:aihut_foreign_indian_city,id',
            'postal_code' => 'required|string|max:8',
            'address' => 'required|string|max:200',
            'salary' => 'required|numeric',
            'photo' => 'nullable|image|max:1024', // Make photo nullable
        ];

        // Custom attribute names for validation messages
        $attributes = [
            'first_name' => 'staff first name',
            'last_name' => 'staff last name',
            'role_id' => 'role',
            // 'department_id' => 'department',
            'country_id' => 'country',
            'city_id' => 'city',
            'photo' => 'profile image',
        ];

        // Validate the input
        $validated = $this->validate($rules, [], $attributes);

        // Handle the photo upload if a new photo is being uploaded
        if ($this->photo) {
            $uuid = Str::uuid();
            $imageExtension = $this->photo->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            // Store the profile image in the storage/app/public directory
            Storage::putFileAs('public/staff_photo', $this->photo, $imageName);

            // Add the image name to the validated data
            $validated['photo'] = $imageName;
        } else {
            // Retain the existing photo if no new photo is uploaded
            unset($validated['photo']);
        }

        // Update the staff record
        Staff::whereId($this->id)->update($validated);

        // Show success alert and redirect to staff index page
        $this->alert('success', Lang::get('messages.staff_update'));
        return to_route('staff.dashboard');
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.profile.profile-component');
    }
}
