<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SaiComponent extends Component
{

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.sai-component');
    }
}
