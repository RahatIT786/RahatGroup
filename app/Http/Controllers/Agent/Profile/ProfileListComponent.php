<?php

namespace App\Http\Controllers\Agent\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProfileListComponent extends Component
{
    use LivewireAlert;

    public $agent;

    public function mount()
    {   
        
        $agentId = auth()->user('agent')->id;
        $this->agent = Agent::find($agentId);
   
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.profile.profile-list-component');
    }
}
