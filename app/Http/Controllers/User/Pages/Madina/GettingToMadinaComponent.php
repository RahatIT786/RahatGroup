<?php

namespace App\Http\Controllers\User\Pages\Madina;

use Livewire\Component;
use Livewire\Attributes\Layout;
class GettingToMadinaComponent extends Component
{
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.madina.getting-to-madina-component');
    }
}
