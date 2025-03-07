<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class HajjGuideComponent extends Component
{

    public function getHajjGuide()
    {   
        $hajjGuide = Content::where('id', 1)->first();  
        
        return $hajjGuide;
    }
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.hajj-guide-component', [
            'QsHajj' => $this->getHajjGuide()
        ]);
    }
}
