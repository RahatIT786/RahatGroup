<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\ComplaintBox;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
class ComplaintBoxListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_sharingtype, $complaintBoxId, $search_name;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    

    public function getcomplaintBox()
    {
        $this->total = ComplaintBox::where('support_team', auth()->user()->id)->count(); // Total count of ComplaintBox enquiry
        $this->complete = ComplaintBox::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count

        return ComplaintBox::query()
        ->where('support_team', auth()->user()->id)
        ->searchLike('guest_name', $this->search_name)
        ->OrderBy('status', 'ASC')
        ->paginate($this->perPage);
    }


    public function completed(ComplaintBox $complaintBox)
    {
        $this->complaintBoxId = $complaintBox->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted',
        ]);
    }

    public function confirmedCompleted()
    {

        $complaintBoxData = ComplaintBox::find($this->complaintBoxId);
        if ($complaintBoxData) {
            $complaintBoxData->update(['status' => 2]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(ComplaintBox $complaintBox)
    {

        $this->complaintBoxId = $complaintBox->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $complaintBoxData = ComplaintBox::find($this->complaintBoxId);
        if ($complaintBoxData) {
            $complaintBoxData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function getModalContent(ComplaintBox $complaintBox)
    {

        $this->modalData = $complaintBox;
        // dd($complaintBox);
    }

    public function filterComplaintBox()
    {
        $this->resetPage();
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.complaint-box-list-component', [
            'ComplaintBox' => $this->getcomplaintBox()
        ]);
    }
}
