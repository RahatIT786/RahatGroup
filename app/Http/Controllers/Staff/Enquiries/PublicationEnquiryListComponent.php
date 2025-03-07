<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\PublicationEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class PublicationEnquiryListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_unique_id, $publicationId, $comment, $status;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    public function getPublicationEnq()
    {
        $this->total = PublicationEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of PublicationEnquiry
        $this->complete = PublicationEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return PublicationEnquiry::query()
        ->where('support_team', auth()->user()->id)
        ->searchLike('unique_id', $this->search_unique_id)
        ->desc()
        ->paginate($this->perPage);
    }

    public function changestatus(PublicationEnquiry $publication)
    {
        $this->status = $publication->status;
        $this->comment = $publication->comment; // Load the comment
        $this->publicationId = $publication->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $publication = PublicationEnquiry::find($this->publicationId);

        if ($publication) {
            $publication->update($validatedData);
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

    public function completed(PublicationEnquiry $publication)
    {
        $this->publicationId = $publication->id;
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

        $publicationData = PublicationEnquiry::find($this->publicationId);
        if ($publicationData) {
            $publicationData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(PublicationEnquiry $publication)
    {

        $this->publicationId = $publication->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $publicationData = PublicationEnquiry::find($this->publicationId);
        if ($publicationData) {
            $publicationData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function getModalContent(PublicationEnquiry $publication)
    {

        $this->modalData = $publication;
        // dd($publication);
    }

    public function filterUmrah()
    {
        $this->resetPage();
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.publication-enquiry-list-component', [
            'Customizedumrah' => $this->getPublicationEnq()
        ]);
    }
}
