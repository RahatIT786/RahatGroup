<?php

namespace App\Http\Controllers\Agent\Settings\SubAgentList;

use App\Helpers\Helper;
use App\Models\UserRegister;

use App\Models\Agent;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Hash;

class SubAgentListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 5, $search_id, $agency_name, $search_subagent, $agencyId = null, $agency, $typesId, $SubAgentData;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getagentList()
    {
        // dd(auth()->user('agents')->id);
        $this->SubAgentData = UserRegister::with('agency')
            ->where('agent_id', auth()->user('agents')->id)
           
            ->searchLike('name', $this->search_subagent)
            // ->desc()
            ->get();

        return UserRegister::query()
            ->where('agent_id', auth()->user('agents')->id)
            
            ->searchLike('name', $this->search_subagent)
            ->desc()
            ->paginate($this->perPage);
    }


    public function toggleStatus(UserRegister $agency)
    {
        // dd($manageFaq);
        $this->agencyId = $agency->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->manageFaqId);

        $agentData = UserRegister::whereId($this->agencyId);
        // dd($faqData);
        $agentData->update(['is_active' => !$agentData->first()->is_active]);
        $this->alert('success', Lang::get('messages.subagent_status_changed'));
    }

    public function isDelete(UserRegister $agency)
    {
        // dd($faq);
        $this->typesId = $agency->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $agentData = UserRegister::whereId($this->typesId);
        $agentData->delete();
        $this->alert('success', Lang::get('messages.subagent_delete'));
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
            return to_route('agent.subAgent.index');
        } else {
            // Send error message if user is not found
            $this->alert('error', Lang::get('User not found'));
            return to_route('agent.subAgent.index');
        }
    }

    public function downloadSubAgentList()
    {
        // Retrieve data filtered by the authenticated agent's ID
        $subAgentData = UserRegister::where('agent_id', auth()->user()->id)->get();
    
        if ($subAgentData->isEmpty()) {
            return response()->json(['error' => 'not found'], 404);
        }
    
        $data = [
            'subAgentData' => $subAgentData,
        ];
    
        $pdf = Pdf::loadView('agent.settings.sub-agent-list.sub-agent-list-pdf-component', $data);
    
        $docName = "Sub_Agent_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }
    


    public function exportToExcel()
    {
        // dd(11);
        $serialNumber = 1;
        // ->where('agent_id', auth()->user('agents')->id);
        $resultArray = $this->SubAgentData->map(function ($subagent) use (&$serialNumber) {
            return [
                'Serial No.' => $serialNumber++,
                // 'Agency Code' => $subagent->agent_id ?? '---',
                // 'Agency' => $subagent->agency->agency_name ?? '---',
                'Sub Agent Name' => $subagent->name ?? '---',
                'City' => $subagent->city ?? '---',
                'Mobile' => $subagent->phone ?? '---',
                'email' => $subagent->email ?? '---',
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'SubAgent.xlsx');
    }

    public function filterAgent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.sub-agent-list.sub-agent-list-component', [
            'agentList' => $this->getagentList()
        ]);
    }
}
