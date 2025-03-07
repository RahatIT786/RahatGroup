<?php

namespace App\Http\Controllers\User\Pages\Makkah;

use Livewire\Attributes\Layout;
use Livewire\Component;

class RestaurantsAndCafesComponent extends Component
{
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.makkah.restaurants-and-cafes-component');
    }
}
