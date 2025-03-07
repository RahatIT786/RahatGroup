<?php

namespace App\Http\Controllers\Staff\Enquiries;

use Livewire\Component;
use App\Models\ServiceEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class ServiceEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $serviceEnquiryId, $name, $support_team, $modalData, $modalRelationship, $comment, $status;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getServiceEnquiry()
    {
        $this->total = ServiceEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of ServiceEnquiry
        $this->complete = ServiceEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ServiceEnquiry::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('name', $this->name)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function getModalContent(ServiceEnquiry $serviceEnquiry)
    {
        $this->modalData = $serviceEnquiry;
    }

    public function changestatus(ServiceEnquiry $serviceEnquiry)
    {
        $this->status = $serviceEnquiry->status;
        $this->comment = $serviceEnquiry->comment; // Load the comment
        $this->serviceEnquiryId = $serviceEnquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $serviceEnquiry = ServiceEnquiry::find($this->serviceEnquiryId);

        if ($serviceEnquiry) {
            $serviceEnquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.serviceEnquiry');
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

    public function filterServiceEnquiry()
    {
        $this->resetPage();
    }

    public function completed(ServiceEnquiry $serviceEnquiry)
    {
        $this->serviceEnquiryId = $serviceEnquiry->id;
        $this->comment = ''; // Reset comment field
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted',
            'input' => 'text', // Show an input field
            'inputPlaceholder' => 'Enter your comment here...',
        ]);
    }

    public function confirmedCompleted()
    {

        $enquiryData = ServiceEnquiry::find($this->serviceEnquiryId);
        if ($enquiryData) {
            $enquiryData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(ServiceEnquiry $serviceEnquiry)
    {

        $this->serviceEnquiryId = $serviceEnquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $enquiryData = ServiceEnquiry::find($this->serviceEnquiryId);
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
        return view('staff.enquiries.service-enquiry-list-component', [
            'serviceEnquirys' => $this->getServiceEnquiry()
        ]);
    }
}
