<?php

namespace App\Http\Controllers\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\ManageBanner;
use App\Models\Agent\Faq;

class HomePageComponent extends Component
{   
    public function getBanners()
    {   
        $banners =  ManageBanner::active()->admin()->get();  
        

        return $banners;
    }

    public function getFaq()
    {   
        $faq =  Faq::active()->admin()->get();  
        
        return $faq;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.home-page-component', [
            'banners' => $this->getBanners(),
            'QsFaq' => $this->getFaq()
        ]);
    }

  
}
