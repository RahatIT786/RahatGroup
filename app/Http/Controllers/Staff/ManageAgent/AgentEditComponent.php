<?php

namespace App\Http\Controllers\Staff\ManageAgent;

use App\Models\State;
use App\Models\Agent;
use App\Models\Staff;
use App\Models\Membership;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;


class AgentEditComponent extends Component
{
    public $state, $profile_img, $agency_name, $owner_name, $state_id, $city, $mobile, $email, $password, $website, $pan, $gst, $is_paid, $agent, $id, $company_logoEdit, $rmstaff, $company_logo;
    public $membership, $rm_staff_id, $website_name;
    use LivewireAlert, WithFileUploads;

    public function mount(Agent $agent)
    {
        $this->id = $agent->id;
        $this->agency_name = $agent->agency_name;
        $this->owner_name = $agent->owner_name;
        $this->state_id = $agent->state_id;
        $this->city = $agent->city;
        $this->mobile = $agent->mobile;
        $this->email = $agent->email;
        $this->password = $agent->password;
        $this->website = $agent->website;
        $this->pan = $agent->pan;
        $this->gst = $agent->gst;
        $this->is_paid = $agent->is_paid;
        $this->rm_staff_id = $agent->rm_staff_id;
        $this->website_name = $agent->website_name;
        $this->company_logoEdit = $agent->company_logo; // Ensure this is the correct attribute

        $this->state = State::pluck('state_name', 'id');
        $this->rmstaff = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    {
        $validated = $this->validate([
            'agency_name' => 'required|max:150',
            'owner_name' => 'required|max:150',
            'state_id' => 'required',
            'city' => 'required|max:150',
            'mobile' => 'required|max:12',
            'email' => 'required|email|max:150',
            'website_name' => 'required|max:150',
            'pan' => 'required|max:45',
            'gst' => 'required|max:45',
            'is_paid' => 'required',
            'rm_staff_id' => 'required',
            // 'company_logo' => 'image|max:2048', // Example: max size of 2MB
        ]);
        // Handle file upload
        if ($this->company_logo) {
            $imageName = $this->company_logo->store('public/company_logo'); // Adjusted to 'public'
            $validated['company_logo'] = basename($imageName);
        }

        $validated['is_active'] = 1; // Assuming this is a default value or logic for activation

        Agent::whereId($this->id)->update($validated);

        $this->alert('success', Lang::get('messages.agent_update'));
        return redirect()->route('staff.manageAgent');
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.manage-agent.agent-edit-component');
    }
}
