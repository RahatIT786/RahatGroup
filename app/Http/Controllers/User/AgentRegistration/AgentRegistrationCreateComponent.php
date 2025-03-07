<?php

namespace App\Http\Controllers\User\AgentRegistration;

use App\Models\Agent;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AgentRegistrationCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $countries, $state, $agency_name, $owner_name, $state_id, $city, $mobile, $email, $password, $website, $pan, $gst, $rm_city_id, $rm_staff_id, $company_logo, $is_active, $membership, $website_name;
    public function mount()
    {
        // dd( $this->membership);
        $this->countries = Country::pluck('countryname', 'id');
        $this->state = State::pluck('state_name', 'id');
    }

    public function save()
    {
        $validated = $this->validate([
            'agency_name' => 'required|string|max:150',
            'owner_name' => 'required|string|max:150',
            'state_id' => 'required',
            'city' => 'required|string|max:150',
            'mobile' => 'required|string|max:12',
            'email' => 'required|email|string|max:150',
            'password' => 'required|string|max:150',
            'pan' => 'required|string|max:45',
            'gst' => 'required|string|max:45',
            'company_logo' => 'required', // Ensure this matches your form field
            'website_name' => 'required|string|max:150', // Added validation for website_name
        ]);
        // dd($validated);
        $validated['is_active'] = $this->is_active ?? 0;
        $validated['membership'] = $this->membership ?? 0;
        $validated['rm_staff_id'] = $this->rm_staff_id ?? 0;

        // Handle file upload
        if ($this->company_logo) {
            $imageName = Str::uuid() . '.' . $this->company_logo->getClientOriginalExtension();
            $this->company_logo->storeAs('company_logo', $imageName, 'public');
            $validated['company_logo'] = $imageName;
        }

        $validated['password'] = Hash::make($validated['password']);

        Agent::create($validated);

        session()->flash('success', 'Agent register successfully.');
        $this->dispatch('reload-page');
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.agent-registration.agent-registration-create-component');
    }
}
