<?php

namespace App\Http\Controllers\Staff\Enquiries;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Laundry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class LaundryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $laundryId, $name, $support_team, $modalData, $modalRelationship, $comment, $status;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getLaundry()
    {
        $this->total = Laundry::where('support_team', auth()->user()->id)->count(); // Total count of Laundry
        $this->complete = Laundry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return Laundry::query()
            ->where('support_team', auth()->user()->id)
            ->searchLike('name', $this->name)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(Laundry $laundry)
    {
        $this->status = $laundry->status;
        $this->comment = $laundry->comment; // Load the comment
        $this->laundryId = $laundry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $laundry = Laundry::find($this->laundryId);

        if ($laundry) {
            $laundry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.laundry');
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


    public function getModalContent(Laundry $laundry)
    {
        $this->modalData = $laundry;
    }

    public function filterLaundry()
    {
        $this->resetPage();
    }

    public function completed(Laundry $laundry)
    {
        $this->laundryId = $laundry->id;
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

        $laundryData = Laundry::find($this->laundryId);
        if ($laundryData) {
            $laundryData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(Laundry $laundry)
    {

        $this->laundryId = $laundry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $laundryData = Laundry::find($this->laundryId);
        if ($laundryData) {
            $laundryData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.laundry-list-component', [
            'laundries' => $this->getLaundry(),
        ]);
    }
}
