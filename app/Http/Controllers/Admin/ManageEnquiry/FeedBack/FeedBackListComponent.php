<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\FeedBack;

use App\Models\FeedBack;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FeedBackListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$typesId,$search_name,$search_email,$feedback_modal_data;
    protected $listeners = ['confirmDelete'];
    public function getfeedbackList()
    {
        return FeedBack::query()
        ->searchLike('cust_name', $this->search_name)
        ->searchLike('cust_email', $this->search_email)
        ->desc()
        ->paginate($this->perPage);

    }

    public function filterfeedback()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function isDelete(FeedBack $feedback)
    {
        // dd($contact);
        $this->typesId = $feedback->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $feedbackData = FeedBack::whereId($this->typesId);
        $feedbackData->delete();
        $this->alert('success', Lang::get('messages.feedback_deleted'));
    }
    public function getfeedback(FeedBack $feedback)
{
    $this->feedback_modal_data = $feedback;
    // Optionally add logging or debugging here
}
    public function render()
    {
        return view('admin.manage-enquiry.feed-back.feed-back-list-component', [
            'Feedback' => $this->getfeedbackList()
        ]);
    }
}
