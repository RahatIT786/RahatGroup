<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\Umrah;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class CustomizedUmrahListComponent extends Component
{
    protected $listeners = ['confirmedCompleted','confirmedReject'];
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $search_sharingtype, $umrahId,$status,$comments;

    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    // public function mount()
    // {
    //     $total = self::count();
    //     $complete = self::where('status', 2)->count();
    // }

    public function getumrah()
    {
        $this->total = Umrah::where('support_team', auth()->user()->id)->count(); // Total count of Umrah enquiry
        $this->complete = Umrah::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count

        return Umrah::query()
        ->where('support_team', auth()->user()->id)
        ->searchLike('sharing_type', $this->search_sharingtype)
        ->OrderBy('status', 'ASC')
        ->paginate($this->perPage);
    }
    public function changestatus(Umrah $umrah)
    {
        $this->status = $umrah->status;
        $this->comments = $umrah->comments; // Load the comment
        $this->umrahId = $umrah->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $umrah = Umrah::find($this->umrahId);

        if ($umrah) {
            $umrah->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.umrah');
    }

    public function rules()
    {
        return [
            'status' => 'required',
            'comments' => 'required',
        ];
    }

    public function validationAttributes()
    {
        return [
            'status' => 'Status',
            'comments' => 'Comment',
        ];
    }



    public function completed(Umrah $umrah)
    {
        $this->umrahId = $umrah->id;
        $this->comments = '';
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedCompleted',
        ]);
    }

    public function confirmedCompleted()
    {

        $umrahData = Umrah::find($this->umrahId);
        if ($umrahData) {
            $umrahData->update(['status' => 2 ,
            'comments' => $this->comments,
        ]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }

    public function rejected(Umrah $umrah)
    {

        $this->umrahId = $umrah->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmedReject',
        ]);
    }

    public function confirmedReject()
    {
        $umrahData = Umrah::find($this->umrahId);
        if ($umrahData) {
            $umrahData->update(['status' => 3]);
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
        } else {
            $this->alert('error', Lang::get('Enquiry Not Found'));
        }
    }


    public function getModalContent(Umrah $umrah)
    {

        $this->modalData = $umrah;
        // dd($umrah);
    }

    public function filterUmrah()
    {
        $this->resetPage();
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.customized-umrah-list-component', [
            'Customizedumrah' => $this->getumrah()
        ]);
    }
}
