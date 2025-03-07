<?php

namespace App\Http\Controllers\Staff\Enquiries;

use App\Models\ShoppingEnquiry;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class ShoppingListComponent extends Component
{
    protected $listeners = ['confirmedCompleted', 'confirmedReject'];
    use WithPagination, LivewireAlert;

    public $perPage = 10, $modalData, $shoppingenquiryId, $status, $comment;
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    public function getshopping()
    {
        $this->total = ShoppingEnquiry::where('support_team', auth()->user()->id)->count(); // Total count of ShoppingEnquiry
        $this->complete = ShoppingEnquiry::where('support_team', auth()->user()->id)->where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count
        return ShoppingEnquiry::query()
            ->where('support_team', auth()->user()->id)
            ->OrderBy('status', 'ASC')
            ->paginate($this->perPage);
    }

    public function changestatus(ShoppingEnquiry $shoppingenquiry)
    {
        $this->status = $shoppingenquiry->status;
        $this->comment = $shoppingenquiry->comment; // Load the comment
        $this->shoppingenquiryId = $shoppingenquiry->id;
    }

    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Find and update the existing record
        $shoppingenquiry = ShoppingEnquiry::find($this->shoppingenquiryId);

        if ($shoppingenquiry) {
            $shoppingenquiry->update($validatedData);
            $this->dispatch('reload-page');

            // Success message
            $this->alert('success', Lang::get('messages.enquiry_status_changed'));
            $this->reset(); // Reset form fields
        } else {
            $this->alert('error', 'Enquiry not found.');
        }
        return redirect()->route('staff.shopping');
    }

    public function getModalContent(ShoppingEnquiry $shoppingenquiry)
    {
        $this->modalData = $shoppingenquiry;
    }

    public function filtershopping()
    {
        $this->resetPage();
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

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.enquiries.shopping-list-component', [
            'Shopping' => $this->getshopping(),
        ]);
    }
}
