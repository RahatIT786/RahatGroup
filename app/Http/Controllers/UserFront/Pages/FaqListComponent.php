<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use App\Models\Agent\Faq;
use Livewire\Attributes\Layout;

class FaqListComponent extends Component
{
    public $search_question;

    public function mount()
    {
        // $this->faqs = Faq::orderByDesc('id')->get();

        // $this->faqs = Faq::where('is_active', true)
        //                  ->orderByDesc('id')
        //                  ->get();
    }

    public function getFaq()
    {
        return Faq::query()->searchLike('question', $this->search_question)->where('is_active', true)->desc()->get();
    }

    public function changeInput()
    {
       //
    }


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.faq-list-component', [
            'faqs' => $this->getFaq()
        ]);
    }
}
