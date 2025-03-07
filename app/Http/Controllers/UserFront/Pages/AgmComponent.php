<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agm;
use App\Models\AgmImage;

class AgmComponent extends Component
{

    public function getAgm()
    {
        return Agm::active()->desc()->with('agmimage')->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.agm-component', [
            'agms' => $this->getAgm()
        ]);
    }
}
