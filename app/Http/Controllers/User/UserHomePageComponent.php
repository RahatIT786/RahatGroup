<?php

namespace App\Http\Controllers\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

class UserHomePageComponent extends Component
{
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user.user-home-page-component');
    }
}
