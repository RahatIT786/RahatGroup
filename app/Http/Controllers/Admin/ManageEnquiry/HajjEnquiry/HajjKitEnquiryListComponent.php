<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\HajjEnquiry;

use Livewire\Component;
use App\Models\HajjKitEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class HajjKitEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;

    public $perPage = 10, $enquiryId, $name, $support_team, $modalData, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getHajjKitEnquiry()
    {
        $this->total = HajjKitEnquiry::count(); // Total count of HajjKitEnquiry enquiry
        $this->complete = HajjKitEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        $enquiry = HajjKitEnquiry::query()
            ->searchLike('name', $this->name)
            ->paginate($this->perPage);
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
        HajjKitEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.hajjKitEnquiry.index');
    }

    public function isDelete(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->enquiryId = $hajjkitEnquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $servicEnquiryData = HajjKitEnquiry::whereId($this->enquiryId);
        $servicEnquiryData->delete();
        $this->alert('success', Lang::get('messages.enquiry_deleted'));
    }

    public function getModalContent(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->modalData = $hajjkitEnquiry;
    }
    public function getModalRelationship(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->modalRelationship = $hajjkitEnquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterHajjKit()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.hajj-enquiry.hajj-kit-enquiry-list-component', [
            'hajjkitEnquirys' => $this->getHajjKitEnquiry()
        ]);
    }
}
