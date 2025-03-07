<?php

namespace App\Http\Controllers\User\Pages\Madina;

use Livewire\Component;
use Livewire\Attributes\Layout;
class MadinaProphetMosqueServiceComponent extends Component
{
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.madina.madina-prophet-mosque-service-component');
    }
}
