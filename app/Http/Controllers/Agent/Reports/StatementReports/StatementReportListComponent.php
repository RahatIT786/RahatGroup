<?php

namespace App\Http\Controllers\Agent\Reports\StatementReports;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agency;
use App\Models\Agent;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class StatementReportListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $agent, $search_agency, $start_date, $end_date, $is_div, $agencyData, $agentBookings, $selected_agent, $tot_cost;

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
    }

    public function mount()
    {
        $this->agent = Agent::where('id', auth()->user()->id)->pluck('agency_name', 'id');
    }

    public function download()
    {

        $data = [
            'agentBookings' => $this->agentBookings,
            'agency' => $this->selected_agent
        ];
        // dd($data);
        $pdf = Pdf::loadView('agent.reports.statement-reports.statement-pdf', $data);

        $docName = "agent_statement_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.reports.statement-reports.statement-report-list-component');
    }
}
