<?php

namespace App\Http\Controllers\Staff\Enquiries;

use Livewire\Component;
use App\Models\TourCallUsBack;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class TourCallUsBackListComponent extends Component
{
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_full_name, $tourcallusbackId, $comment, $status;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    public function getTourCallUsBack()
    {
        $this->total = TourCallUsBack::where('support_team', auth()->user()->id)->count(); // Total count of TourCallUsBack
        $this->complete = TourCallUsBack::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TourCallUsBack::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('full_name', $this->search_full_name)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(TourCallUsBack $tourcallusback)
    {
        $this->status = $tourcallusback->status;
        $this->comment = $tourcallusback->comment; // Load the comment
        $this->tourcallusbackId = $tourcallusback->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $tourcallusback = TourCallUsBack::find($this->tourcallusbackId);

        if ($tourcallusback) {
            $tourcallusback->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            session()->flash('success', 'Feedback successfully submitted.');
            $this->reset(); // Reset form fields
        } else {
            session()->flash('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.tourcallusback');
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

    public function completed(TourCallUsBack $tourcallusback)
    {
        $this->tourcallusbackId = $tourcallusback->id;
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

        $tourcallusbackIdData = TourCallUsBack::find($this->tourcallusbackId);
        if ($tourcallusbackIdData) {
            $tourcallusbackIdData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(TourCallUsBack $tourcallusback)
    {
        $this->tourcallusbackId = $tourcallusback->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }
    public function confirmedReject()
    {
        $tourcallusbackIdData = TourCallUsBack::find($this->tourcallusbackId);
        if ($tourcallusbackIdData) {
            $tourcallusbackIdData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function getModalContent(TourCallUsBack $tourcallusback)
    {

        $this->modalData = $tourcallusback;
        // dd($callusback);
    }

    public function filterTourCallUsBack()
    {
        $this->resetPage();
    }


    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.tour-call-us-back-list-component', [
            'TourCallUsBack' => $this->getTourCallUsBack()
        ]);
    }
}
