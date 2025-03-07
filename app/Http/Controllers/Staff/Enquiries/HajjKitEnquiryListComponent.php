<?php

namespace App\Http\Controllers\Staff\Enquiries;

use Livewire\Component;
use App\Models\HajjKitEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class HajjKitEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $enquiryId, $name, $support_team, $modalData, $modalRelationship, $comment, $status;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getHajjKitEnquiry()
    {
        $this->total = HajjKitEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of HajjKitEnquiry
        $this->complete = HajjKitEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        // dd(auth()->user());
        return HajjKitEnquiry::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('name', $this->name)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function getModalContent(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->modalData = $hajjkitEnquiry;
    }

    public function changestatus(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->status = $hajjkitEnquiry->status;
        $this->comment = $hajjkitEnquiry->comment; // Load the comment
        $this->enquiryId = $hajjkitEnquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $hajjkitEnquiry = HajjKitEnquiry::find($this->enquiryId);

        if ($hajjkitEnquiry) {
            $hajjkitEnquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.hajjKitEnquiry');
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

    public function filterHajjKit()
    {
        $this->resetPage();
    }

    public function completed(HajjKitEnquiry $hajjkitEnquiry)
    {
        $this->enquiryId = $hajjkitEnquiry->id;
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

        $enquiryData = HajjKitEnquiry::find($this->enquiryId);
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

    public function rejected(HajjKitEnquiry $hajjkitEnquiry)
    {

        $this->enquiryId = $hajjkitEnquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $enquiryData = HajjKitEnquiry::find($this->enquiryId);
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
        return view('staff.enquiries.hajj-kit-enquiry-list-component', [
            'hajjkitEnquirys' => $this->getHajjKitEnquiry()
        ]);
    }
}
