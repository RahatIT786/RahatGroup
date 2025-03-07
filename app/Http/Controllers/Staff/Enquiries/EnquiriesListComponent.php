<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\Bookingenquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class EnquiriesListComponent extends Component

{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_name, $search_category, $bookingEnquiryId, $comment, $status;

    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    public function getBookingenquiry()
    {
        $this->total = Bookingenquiry::where('support_team', auth()->user()->id)->count(); // Total count of Bookingenquiry Bookingenquiry
        $this->complete = Bookingenquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        // dd(auth()->user());
        return Bookingenquiry::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('cust_name', $this->search_name)
            ->searchCategory($this->search_category)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(Bookingenquiry $bookingenquiry)
    {
        $this->status = $bookingenquiry->status;
        $this->comment = $bookingenquiry->comment; // Load the comment
        $this->bookingEnquiryId = $bookingenquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $bookingenquiry = Bookingenquiry::find($this->bookingEnquiryId);

        if ($bookingenquiry) {
            $bookingenquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.enquiries');
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

    public function getModalContent(Bookingenquiry $bookingenquiry)
    {

        $this->modalData = $bookingenquiry;
        // dd($bookingenquiry);
    }

    public function filterBooking()
    {
        $this->resetPage();
    }


    public function completed(Bookingenquiry $bookingenquiry)
    {
        $this->bookingEnquiryId = $bookingenquiry->id;
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

        $bookingenquiryData = Bookingenquiry::find($this->bookingEnquiryId);
        if ($bookingenquiryData) {
            $bookingenquiryData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(Bookingenquiry $bookingenquiry)
    {

        $this->bookingEnquiryId = $bookingenquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $bookingenquiryData = Bookingenquiry::find($this->bookingEnquiryId);
        if ($bookingenquiryData) {
            $bookingenquiryData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {

        return view('staff.enquiries.enquiries-list-component', [
            'Bookingenquiry' => $this->getBookingenquiry()
        ]);
    }
}
