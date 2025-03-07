<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ForexEnquiry;

use Livewire\Component;
use App\Models\ForexEnquiry;
use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ForexEnquiryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_full_name, $modalRelationship, $support_team;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getForexEnquiry()
    {
        $this->total = ForexEnquiry::count(); // Total count of ForexEnquiry enquiry
        $this->complete = ForexEnquiry::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ForexEnquiry::query()
            ->searchLike('full_name', $this->search_full_name)
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
        // dd($this->staffMaster);

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
        ForexEnquiry::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.enquiryforex.index');
    }



    public function isDelete(ForexEnquiry $forexenquiry)
    {
        // dd($enquirie);
        $this->typesId = $forexenquiry->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $forexenquiryData = ForexEnquiry::whereId($this->typesId);
        $forexenquiryData->delete();
        $this->alert('success', Lang::get('messages.forexenquiry_deleted'));
    }

    public function getModalContent(ForexEnquiry $forexenquiry)
    {
        $this->modalData = $forexenquiry;
    }

    public function getModalRelationship(ForexEnquiry $forexenquiry)
    {
        $this->modalRelationship = $forexenquiry;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterForexEnquiry()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view('admin.manage-enquiry.forex-enquiry.forex-enquiry-list-component', [
            'ForexEnquiry' => $this->getForexEnquiry()
        ]);
    }
}
