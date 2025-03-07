<?php

namespace App\Http\Controllers\Agent\Users;
use Livewire\Component;
use App\Models\State;
use App\Models\Country;
use App\Models\Agent;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

class UserEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $id, $country,$state,$agency_name,$owner_name,$country_id,$state_id,$city,$mobile,$landline,$email,$website,$login_id,$password,$confirm_password,$profile_logoEdit,$profile_img,$owners_passport,$owners_logoEdit;

    public function mount()
{
    $agentId = auth()->user('agent')->id;
    $agent = Agent::where('id',$agentId)->first();
    $this->country = Country::pluck('countryname', 'id');

    // Populate $state from the database or wherever it's sourced
    $this->state = State::pluck('state_name', 'id'); // Adjust 'state_name' to your actual column name

    $this->id = $agent->id;
    $this->agency_name = $agent->agency_name;
    $this->owner_name = $agent->owner_name;
    $this->country_id = $agent->country_id;
    $this->state_id = $agent->state_id;
    $this->city = $agent->city;
    $this->mobile = $agent->mobile;
    $this->landline = $agent->landline;
    $this->email = $agent->email;
    $this->website = $agent->website;
    $this->login_id = $agent->login_id;
    $this->password = $agent->password;
    $this->confirm_password = $agent->confirm_password;
    $this->profile_logoEdit = $agent->profile_logoEdit;
    $this->owners_logoEdit = $agent->owners_logoEdit;
}

public function update()
{
    try {
        $user = Agent::find($this->id);

        $validated = [
            'agency_name' => $this->agency_name,
            'owner_name' => $this->owner_name,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'city' => $this->city,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'website' => $this->website,
            'password' => $this->password,
            'profile_img' => $this->profile_img,
            'owners_passport' => $this->owners_passport,
        ];
        // dd($this->owners_passport);
        // Update profile image if a new one is uploaded
        if ($this->profile_img) {
            if ($user->profile_img) {
                Storage::delete('public/profile_image/' . $user->profile_img);
            }

            if (is_string($this->profile_img)) {
                $validated['profile_img'] = $this->profile_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->profile_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/profile_image', $this->profile_img, $imageName);
                $validated['profile_img'] = $imageName;
            }
        } else {
            $validated['profile_img'] = $user->profile_img;
        }

        // Update owner's passport if a new one is uploaded
        if ($this->owners_passport) {
            if ($user->owners_passport) {
                Storage::delete('public/profile_image/' . $user->owners_passport);
            }

            if (is_string($this->owners_passport)) {
                $validated['owners_passport'] = $this->owners_passport;
            } else {
                $uuid = Str::uuid();
                $passportExtension = $this->owners_passport->getClientOriginalExtension();
                $passportName = $uuid . '.' . $passportExtension;
                Storage::putFileAs('public/profile_image', $this->owners_passport, $passportName);
                $validated['owners_passport'] = $passportName;
            }
        } else {
            $validated['owners_passport'] = $user->owners_passport;
        }

        $user->update($validated);
        $user->save();

        $this->alert('success', Lang::get('messages.user_update'));
    } catch (\Exception $e) {
        $this->alert('error', 'Something went wrong.');
    }
}




    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.users.user-edit-component');
    }
}
