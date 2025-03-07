<?php

namespace App\Http\Controllers\UserFront;

use Livewire\Component;
use Livewire\Attributes\Layout;

class DashboardComponent extends Component
{
    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.dashboard-component');
    }
}
