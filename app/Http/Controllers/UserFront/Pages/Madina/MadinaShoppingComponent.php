<?php

namespace App\Http\Controllers\UserFront\Pages\Madina;

use Livewire\Component;
use Livewire\Attributes\Layout;

class MadinaShoppingComponent extends Component
{

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.madina.madina-shopping-component');
    }
}
