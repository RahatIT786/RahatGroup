<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;


class AboutUsComponent extends Component
{   
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.about-us-component');
    }
}
