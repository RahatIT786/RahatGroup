<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TourState;


class DomesticTourPackagesComponent extends Component
{
    public function getTourState()
{
    return TourState::active()->asc('name')->get();
}
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.domestic-tour-packages-component', [
            'tourstates' => $this->getTourState()
        ]);
    }
}
