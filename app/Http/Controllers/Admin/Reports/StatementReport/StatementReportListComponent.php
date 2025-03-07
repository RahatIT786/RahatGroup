<?php

namespace App\Http\Controllers\Admin\Reports\StatementReport;

use App\Models\Agency;
use App\Models\Agent;
use App\Models\Booking;
use Livewire\Component;
use App\Helpers\Helper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class StatementReportListComponent extends Component
{
    public $agent, $search_agency, $start_date, $end_date, $is_div, $agencyData, $agentBookings, $selected_agent;

    public function mount()
    {
        $this->agent = Agent::orderBy('agency_name', 'ASC')->pluck('agency_name', 'id');
    }

    public function statementReportData()
    {
        $agentId = $this->search_agency;
        $validated = $this->validate([
            'search_agency' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'search_agency.required' => 'Please select an Agency ',
            'start_date.required' => 'Please Select a Start Date',
            'end_date.required' => 'Please Select a End Date',
        ]);

        $this->is_div = 1;

        $this->agentBookings = Booking::where('booking_status', 1)
            ->with('agency', 'payment')
            ->whereBetween('created_at', [
                Carbon::parse($this->start_date)->startOfDay(),
                Carbon::parse($this->end_date)->endOfDay()
            ])
            ->where('agency_id', $agentId)->get();

        $this->selected_agent = Agency::where('id', $agentId)->first();
        // dd($this->agentBookings[0]->payment);
        // $agentBookings =  $this->agentBookings;
        // return $selected_agent;
    }

    public function download()
    {
        // ini_set('max_execution_time', '360');

        // sleep(3);
        $data = [
            'agentBookings' => $this->agentBookings,
            'agency' => $this->selected_agent
        ];
        // dd($data);
        $pdf = Pdf::loadView('admin.reports.statement-report.statement-pdf', $data);

        $docName = "agent_statement_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function render()
    {
        return view('admin.reports.statement-report.statement-report-list-component');
    }
}
