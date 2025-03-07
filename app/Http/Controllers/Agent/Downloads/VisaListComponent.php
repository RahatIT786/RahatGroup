<?php

namespace App\Http\Controllers\Agent\Downloads;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VisaListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.visa-list-component');
    }
}
