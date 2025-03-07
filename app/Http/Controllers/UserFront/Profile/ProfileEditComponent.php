<?php

namespace App\Http\Controllers\UserFront\Profile;

use App\Models\Country;
use App\Models\Customer;
use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $country, $state, $id, $name, $country_id, $state_id, $city, $mobile, $email, $login_id, $profileImgEdit, $address, $profile_img;
    public function mount(Customer $customer)
    {

        $customer = auth()->user();

        $this->country = Country::pluck('countryname', 'id');

        $this->state = State::pluck('state_name', 'id');

        $this->id = $customer->id;

        $this->name = $customer->name;

        $this->country_id = $customer->country_id;

        $this->state_id = $customer->state_id;

        $this->city = $customer->city;

        $this->mobile = $customer->mobile;

        $this->email = $customer->email;

        $this->login_id = $customer->login_id;

        $this->profileImgEdit = $customer->profile_img;

        $this->address = $customer->address;
    }

    public function update()
    {
        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500', // Add length validation for address if needed
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image upload
        ];

        // Validate the input data
        $validatedData = $this->validate($rules);

        // Find the user
        $user = Customer::find($this->id);

        // Handle profile image upload
        if ($this->profile_img) {
            if ($user->profile_img) {
                Storage::delete('public/user_profile_image/' . $user->profile_img);
            }
            if (is_string($this->profile_img)) {
                $validatedData['profile_img'] = $this->profile_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->profile_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/user_profile_image', $this->profile_img, $imageName);
                $validatedData['profile_img'] = $imageName;
            }
        } else {
            $validatedData['profile_img'] = $user->profile_img;
        }

        // Update the user with validated data
        $user->update($validatedData);

        // Redirect or show success message
        $this->alert('success', Lang::get('messages.user_update'));
        return redirect()->route('customer.profile.index');
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.profile.profile-edit-component');
    }
}
