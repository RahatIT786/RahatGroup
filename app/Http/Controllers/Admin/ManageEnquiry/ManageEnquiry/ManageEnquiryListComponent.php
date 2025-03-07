<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ManageEnquiry;

use Livewire\Component;
use App\Models\Enquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class ManageEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $enquiryId, $name, $serviceType, $support_team, $modalData, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getManageEnquiry()
    {
        $this->total = Enquiry::count(); // Total count of Enquiry enquiry
        $this->complete = Enquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        $enquiry = Enquiry::query()
            ->with('servicetype')
            ->searchLike('name', $this->name)
            ->searchServiceType($this->serviceType)
            // ->orderByRaw('support_team IS NULL DESC')
            // ->get();
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
        Enquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.manageEnquiry.index');
    }

    public function isDelete(Enquiry $enquiry)
    {
        $this->enquiryId = $enquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $enquirytypeId = Enquiry::whereId($this->enquiryId);
        $enquirytypeId->delete();
        $this->alert('success', Lang::get('messages.enquiry_deleted'));
    }

    public function getModalContent(Enquiry $enquiry)
    {
        $this->modalData = $enquiry;
    }
    public function getModalRelationship(Enquiry $enquiry)
    {
        $this->modalRelationship = $enquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterManageEnquiry()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.manage-enquiry.manage-enquiry-list-component', [
            'manageEnquirys' => $this->getManageEnquiry()
        ]);
    }
}
