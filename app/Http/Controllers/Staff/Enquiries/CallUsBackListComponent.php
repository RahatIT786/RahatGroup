<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\CallUsBack;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class CallUsBackListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_full_name, $callusbackId, $comment, $status;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    public function getCallUsBack()
    {
        $this->total = CallUsBack::where('support_team', auth()->user()->id)->count(); // Total count of CallUsBack
        $this->complete = CallUsBack::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return CallUsBack::query()
        ->where('support_team', auth()->user()->id)
        ->searchLike('full_name', $this->search_full_name)
        ->OrderBy('status', 'ASC')
        ->paginate($this->perPage);
    }

    public function changestatus(CallUsBack $callusback)
    {
        $this->status = $callusback->status;
        $this->comment = $callusback->comment; // Load the comment
        $this->callusbackId = $callusback->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $callusback = CallUsBack::find($this->callusbackId);

        if ($callusback) {
            $callusback->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.callusback');
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

    public function completed(CallUsBack $callusback)
    {
        $this->callusbackId = $callusback->id;
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

        $callusbackIdData = CallUsBack::find($this->callusbackId);
        if ($callusbackIdData) {
            $callusbackIdData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function rejected(CallUsBack $callusback)
    {

        $this->callusbackId = $callusback->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $callusbackIdData = CallUsBack::find($this->callusbackId);
        if ($callusbackIdData) {
            $callusbackIdData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function getModalContent(CallUsBack $callusback)
    {

        $this->modalData = $callusback;
        // dd($callusback);
    }

    public function filterCallUsBack()
    {
        $this->resetPage();
    }


    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.call-us-back-list-component', [
            'CallUsBack' => $this->getCallUsBack()
        ]);
    }
}
