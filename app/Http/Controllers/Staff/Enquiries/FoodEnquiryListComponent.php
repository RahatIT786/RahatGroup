<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\FoodEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class FoodEnquiryListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_full_name, $foodenquiryId, $comment, $status;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    public function getFoodEnquiry()
    {
        $this->total = FoodEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of FoodEnquiry
        $this->complete = FoodEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return FoodEnquiry::query()
        ->where('support_team', auth()->user()->id)
        // ->searchLike('full_name', $this->search_full_name)
        ->OrderBy('status', 'ASC')
        ->paginate($this->perPage);
    }

    public function changestatus(FoodEnquiry $foodenquiry)
    {
        $this->status = $foodenquiry->status;
        $this->comment = $foodenquiry->comment; // Load the comment
        $this->foodenquiryId = $foodenquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $foodenquiry = FoodEnquiry::find($this->foodenquiryId);

        if ($foodenquiry) {
            $foodenquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.foodenquiry');
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

    public function completed(FoodEnquiry $foodenquiry)
    {
        $this->foodenquiryId = $foodenquiry->id;
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

        $foodenquiryIdData = FoodEnquiry::find($this->foodenquiryId);
        if ($foodenquiryIdData) {
            $foodenquiryIdData->update([
                'status' => 2,              // Update the status
                'comment' => $this->comment, // Use the Livewire comment property
            ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(FoodEnquiry $foodenquiry)
    {

        $this->foodenquiryId = $foodenquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $foodenquiryIdData = FoodEnquiry::find($this->foodenquiryId);
        if ($foodenquiryIdData) {
            $foodenquiryIdData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function getModalContent(FoodEnquiry $foodenquiry)
    {

        $this->modalData = $foodenquiry;
        // dd($umrah);
    }

    public function filterFoodEnquiry()
    {
        $this->resetPage();
    }


    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.food-enquiry-list-component', [
            'FoodEnquiry' => $this->getFoodEnquiry()
        ]);
    }
}
