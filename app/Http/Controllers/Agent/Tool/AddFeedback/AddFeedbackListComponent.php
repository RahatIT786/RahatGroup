<?php

namespace App\Http\Controllers\Agent\Tool\AddFeedback;
use App\Models\FeedBack;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;

class AddFeedbackListComponent extends Component
{
    use WithFileUploads, LivewireAlert;

    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $cust_num;

    #[Validate]
    public $cust_msg;

    #[Validate]
    public $feedback_cat;

    // Define validation rules

    public function rules()
    {
        return [
            'cust_name' => 'required',
            'cust_email' => 'required|email',
            'cust_num' => 'required',
            'cust_msg' => 'required',
            'feedback_cat' => 'required',
        ];
    }


    // Define custom attribute names for validation messages
    public function validationAttributes()
    {
        return [
            'cust_name' => 'Name',
            'cust_email' => 'Email',
            'cust_num' => 'Contact Number',
            'cust_msg' => 'Message',
            'feedback_cat' => 'Category',
        ];
    }

    // Save the feedback
    public function save()
    {
        // Validate the data
        $validatedData = $this->validate();

        // Create a new feedback record
        FeedBack::create($validatedData);
        $this->dispatch('reload-page');
        // Set a flash message and reset the form

        $this->alert('success', Lang::get('Feedback successfully submitted.'));
        $this->reset(); // Optionally, reset form fields
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        // dd(345345345);
        return view('agent.tool.add-feedback.add-feedback-list-component');
    }
}
