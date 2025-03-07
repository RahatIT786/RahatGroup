<?php

namespace App\Http\Controllers\Agent\Reports;

use Livewire\Attributes\Layout;
use Livewire\Component;

class StatementReportListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.reports.statement-report-list-component');
    }
}
