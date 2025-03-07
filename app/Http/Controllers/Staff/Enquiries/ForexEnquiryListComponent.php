<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\ForexEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class ForexEnquiryListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_full_name, $forexenquiryId,$status, $comment;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    public function getForexEnquiry()
    {
        $this->total = ForexEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of ForexEnquiry
        $this->complete = ForexEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ForexEnquiry::query()
        ->where('support_team', auth()->user()->id)
        ->searchLike('full_name', $this->search_full_name)
        ->OrderBy('status', 'ASC')
        ->paginate($this->perPage);
    }
    // public function completed(ForexEnquiry $forexenquiry)
    // {
    //     $this->forexenquiryId = $forexenquiry->id;
    //     $this->confirm('Are you sure to change status?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmedCompleted',
    //     ]);
    // }

    // public function confirmedCompleted()
    // {

    //     $forexenquiryIdData = ForexEnquiry::find($this->forexenquiryId);
    //     if ($forexenquiryIdData) {
    //         $forexenquiryIdData->update(['status' => 2]);
    //         $this->alert('success', Lang::get('messages.enquiry_status_changed'));
    //     } else {
    //         $this->alert('error', Lang::get('Enquiry Not Found'));
    //     }
    // }


    // public function rejected(ForexEnquiry $forexenquiry)
    // {

    //     $this->forexenquiryId = $forexenquiry->id;
    //     $this->confirm('Are you sure to change status?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmedReject',
    //     ]);
    // }

    // public function confirmedReject()
    // {
    //     $forexenquiryIdData = ForexEnquiry::find($this->forexenquiryId);
    //     if ($forexenquiryIdData) {
    //         $forexenquiryIdData->update(['status' => 3]);
    //         $this->alert('success', Lang::get('messages.enquiry_status_changed'));
    //     } else {
    //         $this->alert('error', Lang::get('Enquiry Not Found'));
    //     }
    // }

    public function changestatus(ForexEnquiry $forexenquiry)
    {
        $this->status = $forexenquiry->status;
        $this->comment = $forexenquiry->comment; // Load the comment
        $this->forexenquiryId = $forexenquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $forexenquiry = ForexEnquiry::find($this->forexenquiryId);

        if ($forexenquiry) {
            $forexenquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.forexenquiry');
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



    public function getModalContent(ForexEnquiry $forexenquiry)
    {

        $this->modalData = $forexenquiry;
        // dd($umrah);
    }

    public function filterForexEnquiry()
    {
        $this->resetPage();
    }


    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.forex-enquiry-list-component', [
            'ForexEnquiry' => $this->getForexEnquiry()
        ]);
    }
}
