<?php

namespace App\Http\Controllers\Agent\Reports;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ClientReportListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.reports.client-report-list-component');
    }
}
