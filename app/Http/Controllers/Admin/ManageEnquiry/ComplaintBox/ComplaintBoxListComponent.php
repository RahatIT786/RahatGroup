<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ComplaintBox;

use App\Models\ComplaintBox;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ComplaintBoxListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId, $modalData = null, $search_sharingtype, $support_team, $modalRelationship;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getcomplaintBox()
    {
        $this->total = ComplaintBox::where('support_team', auth()->user()->id)->count(); // Total count of ComplaintBox enquiry
        $this->complete = ComplaintBox::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ComplaintBox::query()
            // ->searchLike('sharing_type', $this->search_sharingtype)
            ->OrderBy('status', 'ASC')
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
        ComplaintBox::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.complaintBox_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.complaintBox.index');
    }

    public function isDelete(ComplaintBox $complaintBox)
    {
        // dd($enquirie);
        $this->typesId = $complaintBox->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = ComplaintBox::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.complaintBox_deleted'));
    }

    public function getModalContent(ComplaintBox $complaintBox)
    {
        $this->modalData = $complaintBox;
    }

    public function getModalRelationship(ComplaintBox $complaintBox)
    {
        $this->modalRelationship = $complaintBox;
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterComplaintBox()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.manage-enquiry.complaint-box.complaint-box-list-component', [
            'ComplaintBox' => $this->getcomplaintBox()
        ]);
    }
}
