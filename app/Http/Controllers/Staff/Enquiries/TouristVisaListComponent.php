<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\TouristVisa;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class TouristVisaListComponent extends Component
{
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $cust_name, $visa_type, $visaId,$status,$comment;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;
    public function getTouristVisa()
    {
        $this->total = TouristVisa::where('support_team', auth()->user()->id)->count(); // Total count of TouristVisa TouristVisa
        $this->complete = TouristVisa::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return TouristVisa::query()
            ->where('support_team', auth()->user()->id)
            ->with('country')
            ->searchLike('visa_type', $this->visa_type)
            ->searchLike('cust_name', $this->cust_name)
            // ->desc('support_team')
            // ->orderByRaw('support_team IS NULL DESC')
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(TouristVisa $touristVisa)
    {
        $this->status = $touristVisa->status;
        $this->comment = $touristVisa->comment; // Load the comment
        $this->visaId = $touristVisa->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $touristVisa = TouristVisa::find($this->visaId);

        if ($touristVisa) {
            $touristVisa->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.touristVisa');
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


    public function getModalContent(TouristVisa $touristVisa)
    {
        $this->modalData = $touristVisa;
        // dd($this->modalData);
    }

    public function filterTouristVisa()
    {
        $this->resetPage();
    }

    public function completed(TouristVisa $touristVisa)
    {
        $this->visaId = $touristVisa->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted',
        ]);
    }

    public function confirmedCompleted()
    {

        $visaData = TouristVisa::find($this->visaId);
        if ($visaData) {
            $visaData->update(['status' => 2]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(TouristVisa $touristVisa)
    {

        $this->visaId = $touristVisa->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $visaData = TouristVisa::find($this->visaId);
        if ($visaData) {
            $visaData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.tourist-visa-list-component', [
            'touristVisa' => $this->getTouristVisa()
        ]);
    }
}
