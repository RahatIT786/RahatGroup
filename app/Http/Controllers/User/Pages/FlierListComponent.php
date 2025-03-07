<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Flier;

class FlierListComponent extends Component
{

    public function getFlier()
    {
        return Flier::active()->desc()->get();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.flier-list-component', [
            'fliers' => $this->getFlier()
        ]);
    }
}
