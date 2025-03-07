<?php

namespace App\Http\Controllers\User;
use App\Models\FeedBack;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FeedBackComponent extends Component
{
    use WithFileUploads;

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
            'cust_num' => 'required|min:10|max:10',
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
        // $this->dispatch('reload-page');
        // Set a flash message and reset the form
        session()->flash('feed_success', 'Feedback successfully submitted.');
        $this->reset();
    }



    public function render()
    {
        return view('user.feed-back-component');
    }
}
