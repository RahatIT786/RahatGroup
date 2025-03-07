<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\TransportEnquiry;

use Livewire\Component;
use App\Models\TransportEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class TransportEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $enquiryId, $name, $support_team, $modalData, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getTransportEnquiry()
    {
        $this->total = TransportEnquiry::count(); // Total count of TransportEnquiry enquiry
        $this->complete = TransportEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        $enquiry = TransportEnquiry::query()
            ->searchLike('name', $this->name)
            ->paginate($this->perPage);
        // dd($enquiry);
        return $enquiry;
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
        TransportEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.trnsportEnquiry.index');
    }

    public function isDelete(TransportEnquiry $transportEnquiry)
    {
        $this->enquiryId = $transportEnquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $enquiryData = TransportEnquiry::whereId($this->enquiryId);
        $enquiryData->delete();
        $this->alert('success', Lang::get('messages.transport_delete'));
    }

    public function getModalContent(TransportEnquiry $transportEnquiry)
    {
        $this->modalData = $transportEnquiry;
    }
    public function getModalRelationship(TransportEnquiry $transportEnquiry)
    {
        $this->modalRelationship = $transportEnquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterTransportEnquiry()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.transport-enquiry.transport-enquiry-list-component', [
            'transportEnquirys' => $this->getTransportEnquiry()
        ]);
    }
}
