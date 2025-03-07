<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ServiceEnquiry;

use Livewire\Component;
use App\Models\ServiceEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class ServiceEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $serviceEnquiryId, $name, $support_team, $modalData, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getServiceEnquiry()
    {
        $this->total = ServiceEnquiry::count(); // Total count of ServiceEnquiry enquiry
        $this->complete = ServiceEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        $enquiry = ServiceEnquiry::query()
            ->searchLike('name', $this->name)
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
        ServiceEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        return redirect()->route('admin.serviceEnquiry.index');
    }

    public function isDelete(ServiceEnquiry $serviceEnquiry)
    {
        $this->serviceEnquiryId = $serviceEnquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $servicEnquiryData = ServiceEnquiry::whereId($this->serviceEnquiryId);
        $servicEnquiryData->delete();
        $this->alert('success', Lang::get('messages.enquiry_deleted'));
    }

    public function getModalContent(ServiceEnquiry $serviceEnquiry)
    {
        $this->modalData = $serviceEnquiry;
    }
    public function getModalRelationship(ServiceEnquiry $serviceEnquiry)
    {
        $this->modalRelationship = $serviceEnquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterServiceEnquiry()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.service-enquiry.service-enquiry-list-component', [
            'serviceEnquirys' => $this->getServiceEnquiry()
        ]);
    }
}
