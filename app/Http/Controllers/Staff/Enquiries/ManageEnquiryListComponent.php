<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\Enquiry;
use App\Models\City;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class ManageEnquiryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $enquiryId, $name, $serviceType, $support_team,$comment, $modalData,$status;
    public $staffMaster;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];

    public function getManageEnquiry()
    {
        $this->total = Enquiry::where('support_team', auth()->user()->id)->count(); // Total count of Enquiry enquiry
        $this->complete = Enquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        // dd(auth()->user());
        return Enquiry::query()
        ->where('support_team', auth()->user()->id)
        ->with('servicetype', 'city')
            ->searchLike('name', $this->name)
            ->searchServiceType($this->serviceType)
            // ->orderByRaw('support_team IS NULL DESC')
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function getModalContent(Enquiry $enquiry)
    {
        $this->modalData = $enquiry;
    }

    public function filterManageEnquiry()
    {
        $this->resetPage();
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $enquiry = Enquiry::find($this->enquiryId);

        if ($enquiry) {
            $enquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.manageEnquiry');
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



    public function completed(Enquiry $enquiry)
    {
        $this->enquiryId = $enquiry->id;
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

        $enquiryData = Enquiry::find($this->enquiryId);
        if ($enquiryData) {
            $enquiryData->update(['status' => 2,
            'comment' => $this->comment,
        ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function rejected(Enquiry $enquiry)
    {

        $this->enquiryId = $enquiry->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $enquiryData = Enquiry::find($this->enquiryId);
        if ($enquiryData) {
            $enquiryData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function changestatus(Enquiry $enquiry)
    {
        $this->status = $enquiry->status;
        $this->comment = $enquiry->comment; // Load the comment
        $this->enquiryId = $enquiry->id;
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.manage-enquiry-list-component', [
            'manageEnquirys' => $this->getManageEnquiry()
        ]);
    }
}
