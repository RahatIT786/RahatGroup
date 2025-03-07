<?php

namespace App\Http\Controllers\Admin\Components;

use App\Models\FeedBack;
use Livewire\Component;

class CustomerFeedbackComponent extends Component
{
    public $feedbackCount;

    public function mount()
    {
        $this->feedbackCount = FeedBack::active()->count();
    }

    public function getFeedbacks()
    {
        return FeedBack::active()->desc()->take(4)->get();
    }

    public function render()
    {
        return view('admin.components.customer-feedback-component', [
            'feedbacks' => $this->getFeedbacks(),
        ]);
    }
}
