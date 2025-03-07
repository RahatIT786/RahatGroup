<?php

namespace App\Http\Controllers\Staff\Enquiries;

use Livewire\Component;
use App\Models\TransportEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;


class TransportEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $enquiryId, $name, $support_team, $modalData, $modalRelationship, $status, $comment;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getTransportEnquiry()
    {
        $this->total = TransportEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of TransportEnquiry
        $this->complete = TransportEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TransportEnquiry::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('name', $this->name)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(TransportEnquiry $transportEnquiry)
    {
        $this->status = $transportEnquiry->status;
        $this->comment = $transportEnquiry->comment; // Load the comment
        $this->enquiryId = $transportEnquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $transportEnquiry = TransportEnquiry::find($this->enquiryId);

        if ($transportEnquiry) {
            $transportEnquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.transportEnquiry');
    }

    public function rules()
    {
        return [
            'status' => 'required',
            'comment' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'status' => 'Status',
            'comment' => 'Comment',
        ];
    }

    public function getModalContent(TransportEnquiry $transportEnquiry)
    {
        $this->modalData = $transportEnquiry;
    }

    public function filterTransportEnquiry()
    {
        $this->resetPage();
    }

    public function completed(TransportEnquiry $transportEnquiry)
    {
        $this->enquiryId = $transportEnquiry->id;
        $this->comment = '';
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted', // Call method upon confirmation
            'input' => 'text',
        ]);
    }
    public function confirmedCompleted()
    {

        $enquiryData = TransportEnquiry::find($this->enquiryId);
        if ($enquiryData) {
            $enquiryData->update(['status' => 2,
            'comment' => $this->comment,
        ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function rejected(TransportEnquiry $transportEnquiry)
    {

        $this->enquiryId = $transportEnquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $enquiryData = TransportEnquiry::find($this->enquiryId);
        if ($enquiryData) {
            $enquiryData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.transport-enquiry-list-component', [
            'transportEnquirys' => $this->getTransportEnquiry()
        ]);
    }
}
