<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agm;
use App\Models\AgmImage;

class AgmListComponent extends Component
{

    public function getAgm()
    {
        return Agm::active()->desc()->with('agmimage')->get();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.agm-list-component', [
            'agms' => $this->getAgm()
        ]);
    }
}
