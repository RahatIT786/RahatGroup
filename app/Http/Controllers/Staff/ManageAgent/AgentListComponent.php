<?php

namespace App\Http\Controllers\Staff\ManageAgent;

use App\Models\Agency;
use App\Models\Agent;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class AgentListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'agentLogin'];

    public $perPage = 5, $search_agency_name, $search_name, $search_agency_code, $agency_id, $modalData, $agentStsId;

    #[Layout('staff.layouts.app')]
    public function getAgent()
    {       


        // $a = Staff::get();
        // $b = Agent::get();
        // dd($a,$b,auth()->user()->id);
        
        return Agent::query()
            ->where('rm_staff_id', auth()->user()->id)
            ->searchLike('id', $this->search_agency_code)
            ->searchLike('agency_name', $this->search_agency_name)
            ->searchLike('owner_name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function askToLogin(Agency $agency)
    {
        $this->agency_id = $agency->id;
        $this->confirm('Are you sure to login?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'agentLogin',
        ]);
    }

    public function agentLogin()
    {
        $agency = Agency::find($this->agency_id);

        // if ($agency) {
        //     Auth::guard('agent')->login($agency);

        //     return redirect()->route('agent.dashboard');
        // }
        // $this->alert('success', 'Agent not found');

        if ($agency) {
            Auth::guard('agent')->login($agency);
            $this->dispatch('agent-logged-in', url: route('agent.dashboard'));
            // $this->dispatch('agent-logged-in', ['url' => route('agent.dashboard')]);
        } else {
            $this->alert('success', 'Agent not found');
        }
    }
    public function toggleStatus(Agent $agentsts)
    {
        // dd($agentsts);
        $this->agentStsId = $agentsts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $agentstsData = Agent::whereId($this->agentStsId);
        $agentstsData->update(['is_active' => !$agentstsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.agent_status_changed'));
    }

    public function getModalContent(Agent $agent)
    {
        // dd($agent);
        $this->modalData = $agent;
    }


    public function filterAgent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function render()
    {
        return view('staff.manage-agent.agent-list-component', [
            'agents' => $this->getAgent()
        ]);
    }
}
