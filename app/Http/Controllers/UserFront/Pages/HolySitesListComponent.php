<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class HolySitesListComponent extends Component
{

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.holy-sites-list-component');
    }
}
