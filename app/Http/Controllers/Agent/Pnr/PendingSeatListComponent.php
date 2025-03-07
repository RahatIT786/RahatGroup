<?php

namespace App\Http\Controllers\Agent\Pnr;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PendingSeatListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.pnr.pending-seat-list-component');
    }
}
