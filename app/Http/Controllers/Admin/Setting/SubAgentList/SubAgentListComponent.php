<?php

namespace App\Http\Controllers\Admin\Setting\SubAgentList;

use App\Helpers\Helper;
use App\Models\UserRegister;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class SubAgentListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $perPage = 10, $agentStsId, $subagentDeleteId, $search_agency_code, $search_sub_agent, $search_agency, $SubAgentData;
    public function getSubAgent()
    {
        $this->SubAgentData = UserRegister::with('agency')
            ->searchLike('agent_id', $this->search_agency_code)
            ->searchLike('name', $this->search_sub_agent)
            ->searchAgent($this->search_agency)
            ->desc()
            ->get();

        return UserRegister::query()
            ->with('agency')
            ->searchLike('agent_id', $this->search_agency_code)
            ->searchLike('name', $this->search_sub_agent)
            ->searchAgent($this->search_agency)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(UserRegister $agentsts)
    {
        $this->agentStsId = $agentsts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $agentstsData = UserRegister::whereId($this->agentStsId);
        $agentstsData->update(['is_active' => !$agentstsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.subagent_status_changed'));
    }

    public function isDelete(UserRegister $subagentdelete)
    {
        $this->subagentDeleteId = $subagentdelete->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $agentDltData = UserRegister::whereId($this->subagentDeleteId);
        $agentDltData->delete();
        $this->alert('success', Lang::get('messages.subagent_delete'));
    }

    public function downloadAgentList()
    {
        // Retrieve data
        // $subAgentData = Agent::get();
        $subAgentData = UserRegister::get();

        if (!$subAgentData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'subAgentData' => $subAgentData,
        ];
        $pdf = Pdf::loadView('admin.setting.sub-agent-list.sub-agent-pdf-component', $data);

        $docName = "Sub_Agent_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function exportToExcel()
    {
        // dd(11);
        $serialNumber = 1;
        $resultArray = $this->SubAgentData->map(function ($subagent) use (&$serialNumber) {
            return [
                'Serial No.' => $serialNumber++,
                'Agency Code' => $subagent->agent_id ?? '---',
                'Agency' => $subagent->agency->agency_name ?? '---',
                'Sub Agent Name' => $subagent->name ?? '---',
                'City' => $subagent->city ?? '---',
                'Mobile' => $subagent->phone ?? '---',
                'email' => $subagent->email ?? '---',
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'SubAgent.xlsx');
    }

    public function filterSubAgent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function resetPassword($id)
    {
        $user = UserRegister::find($id);
        // dd($user);

        // Check if user is found
        if ($user) {
            // Reset the password
            $user->password = Hash::make('12345');
            $user->updated_at = now();
            $user->save();

            // Send success message
            $this->alert('success', Lang::get('messages.subagent_pw_reset'));
            return to_route('admin.subagentlist.index');
        } else {
            // Send error message if user is not found
            $this->alert('error', Lang::get('User not found'));
            return to_route('admin.subagentlist.index');
        }
    }

    // alert('success', Lang::get('messages.staff_update'));

    public function render()
    {
        // dd($this->getSubAgent());
        return view('admin.setting.sub-agent-list.sub-agent-list-component', [
            'subAgents' => $this->getSubAgent()

        ]);
    }
}
