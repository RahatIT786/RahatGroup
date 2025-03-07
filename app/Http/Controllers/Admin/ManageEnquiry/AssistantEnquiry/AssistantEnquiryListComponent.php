<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\AssistantEnquiry;

use Livewire\Component;
use App\Models\AssistantEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AssistantEnquiryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_name, $modalRelationship, $support_team;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getAssistantEnquiry()
    {
        $this->total = AssistantEnquiry::count(); // Total count of AssistantEnquiry enquiry
        $this->complete = AssistantEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return AssistantEnquiry::query()
            ->searchLike('name', $this->search_name)
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
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
            'status'    => 1
        ];
        AssistantEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.enquiryassistant.index');
    }



    public function isDelete(AssistantEnquiry $assistantenquiry)
    {
        $this->typesId = $assistantenquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $assistantenquiryData = AssistantEnquiry::whereId($this->typesId);
        $assistantenquiryData->delete();
        $this->alert('success', Lang::get('messages.assistantenquiry_deleted'));
    }

    public function getModalContent(AssistantEnquiry $assistantenquiry)
    {
        $this->modalData = $assistantenquiry;
    }

    public function getModalRelationship(AssistantEnquiry $assistantenquiry)
    {
        $this->modalRelationship = $assistantenquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterAssistantEnquiry()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.manage-enquiry.assistant-enquiry.assistant-enquiry-list-component', [
            'AssistantEnquiry' => $this->getAssistantEnquiry()
        ]);
    }
}
