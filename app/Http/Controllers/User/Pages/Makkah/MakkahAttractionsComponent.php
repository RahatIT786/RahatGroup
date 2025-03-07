<?php

namespace App\Http\Controllers\User\Pages\Makkah;

use Livewire\Component;
use Livewire\Attributes\Layout;
class MakkahAttractionsComponent extends Component
{
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.makkah.makkah-attractions-component');
    }
}
