<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class EntranceToUmrahComponent extends Component
{

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.entrance-to-umrah-component');
    }
}
