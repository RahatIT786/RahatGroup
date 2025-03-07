<?php

namespace App\Http\Controllers\Agent\Downloads;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TicketListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.ticket-list-component');
    }
}
