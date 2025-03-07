<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class BaitulMuqaddasGuideComponent extends Component
{
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.baitul-muqaddas-guide-component');
    }
}
