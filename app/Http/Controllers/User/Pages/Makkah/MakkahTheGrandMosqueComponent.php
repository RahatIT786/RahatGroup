<?php

namespace App\Http\Controllers\User\Pages\Makkah;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MakkahTheGrandMosqueComponent extends Component
{
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.makkah.makkah-the-grand-mosque-component');
    }
}
