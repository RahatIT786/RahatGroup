<?php

namespace App\Http\Controllers\Admin\Setting\AgentList;

use App\Helpers\Helper;
use App\Models\Agency;
use App\Models\Agent;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AgentListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete', 'agentLogin'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $rm_staff_id, $modalRelationship, $search_email, $staffMaster, $search_agency_code, $search_agency, $search_name, $agentStsId, $agent_modal_data, $agentDeleteId, $agentDataExcel, $agency_id, $search_mobile;
    public $owner_modal_data, $search_status;
    public function getAgent()
    {
        $this->agentDataExcel = Agent::query()
            ->searchLike('id', $this->search_agency_code)
            ->searchLike('agency_name', $this->search_agency)
            ->searchLike('owner_name', $this->search_name)
            ->searchLike('mobile', $this->search_mobile)
            ->searchLike('email', $this->search_email)
            ->searchStatus('is_active', $this->search_status)
            ->get();

        return Agent::query()
            ->searchLike('id', $this->search_agency_code)
            ->searchLike('agency_name', $this->search_agency)
            ->searchLike('owner_name', $this->search_name)
            ->searchLike('mobile', $this->search_mobile)
            ->searchLike('email', $this->search_email)
            ->searchStatus('is_active', $this->search_status)
            ->desc()
            ->paginate($this->perPage);
    }

    public function mount()
    {
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    {
        $validated = $this->validate([
            'rm_staff_id' => 'required',
        ]);

        $form_data = [
            'rm_staff_id' => $this->rm_staff_id,
        ];
        Agent::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.agentlist.index');
    }

    public function getModalRelationship(Agent $agent)
    {
        $this->modalRelationship = $agent;
        $this->rm_staff_id = $this->modalRelationship->rm_staff_id;
    }

    public function toggleStatus(Agent $agentsts)
    {
        $this->agentStsId = $agentsts->id;
        if ($agentsts->rm_staff_id == 0) {
            $this->alert('warning', 'Please select the relationship manager first.');
        } else {
            $this->confirm('Are you sure to change status?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
            ]);
        }
    }

    public function confirmed()
    {
        $agentstsData = Agent::whereId($this->agentStsId);
        $agentstsData->update(['is_active' => !$agentstsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.agent_status_changed'));
    }

    public function getAgentContent(Agent $agent)
    {
        $agent->load('state');
        $this->agent_modal_data = $agent;
    }


    public function getownerContent(Agent $agent)
    {
        $this->owner_modal_data = $agent;
    }


    public function isDelete(Agent $agentdelete)
    {
        $this->agentDeleteId = $agentdelete->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $agentDltData = Agent::whereId($this->agentDeleteId);
        $agentDltData->delete();
        $this->alert('success', Lang::get('messages.agent_delete'));
    }

    public function downloadAgentList()
    {
        // Retrieve data
        // $agentData = Agent::get();
        $agentData = $this->agentDataExcel;

        if (!$agentData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'agentData' => $agentData,
        ];
        // dd($data);
        $pdf = Pdf::loadView('admin.setting.agent-list.agent-pdf-component', $data)->setPaper('a4', 'landscape');

        $docName = "Agent_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function exportToExcel()
    {
        $resultArray = $this->agentDataExcel->map(function ($agentDataExcel) {
            return  [
                'Serial No.'            => $agentDataExcel->id,
                'Agency Code'            => $agentDataExcel->id,
                'Agency'                  => $agentDataExcel->agency_name ?? '-',
                'Name'                  => $agentDataExcel->owner_name ?? '-',
                'City'                  => $agentDataExcel->city ?? '-',
                'Mobile'                  => $agentDataExcel->mobile ?? '-',
                'Email'                  => $agentDataExcel->email ?? '-',
                'Is Paid'                  => $agentDataExcel->is_paid == 1 ? 'Paid' : 'Unpaid',
            ];
        })->toArray();
        return Helper::exportToExcel($resultArray, 'All Agent.xlsx');
    }

    public function filterAgent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
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

    public function render()
    {
        return view('admin.setting.agent-list.agent-list-component', [
            'agentLists' => $this->getAgent()
        ]);
    }
}
