<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\PnrEnquiry;

use App\Models\Staff;
use App\Models\TicketEnquiry;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PnrEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $search_name, $modalData, $modalRelationship, $support_team, $search_category;
    public $selectedServiceType;
    public $serviceTypes, $packageMaster, $packageType, $staffMaster, $search_unique_id, $staffmaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getPnrEnquiry()
    {
        $this->total = TicketEnquiry::count(); // Total count of TicketEnquiry enquiry
        $this->complete = TicketEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TicketEnquiry::query()
            ->searchLike('name', $this->search_name)
            ->searchLike('unique_id', $this->search_unique_id)
            ->desc()
            ->paginate($this->perPage);
    }

    public function mount()
    {
        // $this->serviceTypes = ServiceType::pluck('name', 'id');
        // $this->packageMaster = Packages::pluck('name', 'id');
        // $this->packageType = PackageType::pluck('package_type', 'id');
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staffmaster) {
                return [$staffmaster->id => $staffmaster->first_name . ' ' . $staffmaster->last_name];
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
        TicketEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.pnrEnquiry');
    }

    public function isDelete(TicketEnquiry $ticketEnquiry)
    {
        $this->typesId = $ticketEnquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $PnrData = TicketEnquiry::whereId($this->typesId);
        $PnrData->delete();
        $this->alert('success', Lang::get('messages.ticket_enquiry_deleted', [
            'timer' => 5000,
        ]));
    }

    public function getModalContent(TicketEnquiry $pnrenquiry)
    {
        $this->modalData = $pnrenquiry;
    }

    public function getModalRelationship(TicketEnquiry $pnrenquiry)
    {

        $this->modalRelationship = $pnrenquiry;
        // dd($this->modalRelationship);
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterPnr()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-enquiry.pnr-enquiry.pnr-enquiry-list-component', [
            'pnrEnquiries' => $this->getPnrEnquiry()
        ]);
    }
}
