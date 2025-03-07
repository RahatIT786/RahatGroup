<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Flier;

class FlierListComponent extends Component
{
    public function getFlier()
    {
        return Flier::active()->desc()->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.flier-list-component', [
            'fliers' => $this->getFlier()
        ]);
    }
}
