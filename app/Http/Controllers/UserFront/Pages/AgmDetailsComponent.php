<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agm;

class AgmDetailsComponent extends Component
{
    public $agm;

    public function mount($id)
    {
        $this->agm = Agm::active()->desc()->where('id', $id)->first();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.agm-details-component');
    }
}
