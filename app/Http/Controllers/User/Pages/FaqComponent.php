<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Faq;

class FaqComponent extends Component
{


    public function getFaq()
    {   
        $faq =  Faq::active()->admin()->get();  
        
        return $faq;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.faq-component', [
            'QsFaq' => $this->getFaq()
        ]);
    }
}
