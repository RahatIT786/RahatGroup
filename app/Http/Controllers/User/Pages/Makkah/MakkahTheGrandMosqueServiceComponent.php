<?php

namespace App\Http\Controllers\User\Pages\Makkah;

use Livewire\Component;
use Livewire\Attributes\Layout;
class MakkahTheGrandMosqueServiceComponent extends Component
{
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.makkah.makkah-the-grand-mosque-service-component');
    }
}
