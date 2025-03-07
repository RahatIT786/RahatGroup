<?php

namespace App\Http\Controllers\Agent\Pnr;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PnrFlightDetailsListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.pnr.pnr-flight-details-list-component');
    }
}
