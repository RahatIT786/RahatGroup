<?php

namespace App\Http\Controllers\UserFront\Pages\Makkah;

use Livewire\Component;
use Livewire\Attributes\Layout;

class MakkahTheGrandMosqueServiceComponent extends Component
{

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.makkah.makkah-the-grand-mosque-service-component');
    }
}
