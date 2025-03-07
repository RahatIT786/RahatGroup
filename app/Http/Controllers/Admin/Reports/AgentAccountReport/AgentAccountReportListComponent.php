<?php

namespace App\Http\Controllers\Admin\Reports\AgentAccountReport;

use App\Helpers\Helper;
use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;


use OpenSpout\Common\Entity\Style\Style;
use Illuminate\Support\Collection;

class AgentAccountReportListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $Agents, $currentSegment, $search_booking_id, $search_name, $perPage = 10, $agentreport_modal_data;
    public function getAgentAccount()
    {
        // $this->Agents
        $query =  Booking::query()
            ->with('agency', 'servicetype', 'pnr') // Load the agent relationship
            ->whereNotNull('booking_id')
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc();

        $this->Agents = $query->get();

        return $query->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function getAgentReportContent(Booking $agentreport)
    {
        // dd($agentreport->pnr->flightdetails->flight_name);
        $this->agentreport_modal_data = $agentreport;

        $booking = Booking::where('booking_id', $agentreport->booking_id)->first();

        // $this->tot_cost = $booking->tot_cost;
    }

    public function download()
    {
        ini_set('max_execution_time', '3600');
        $data = [
            'Agent_Data' => $this->Agents
        ];
        // dd($data['Agent_Data'][0]);
        $pdf = Pdf::loadView('admin.reports.agent-account-report.report-pdf', $data);

        $docName = "Agent_Accounts_List" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function exportToExcel()
    {

        $resultArray = $this->Agents->map(function ($agent, $index) {
            return  [
                'Serial_No'         => $index + 1,
                'Booking_Date'      => $agent->created_at,
                'Software Id'       => $agent->booking_id ?? '-',
                'Service'           => $agent->servicetype->name ?? '-',
                'Dept City'         => $agent->city->city_name ?? '-',
                'Agency'            => $agent->agency->agency_name ?? '-',
                'Travel Date'       => $agent->travel_date ?? '-',
                'Package Type'      => $agent->packagetype->package_type ?? '-',
                'Name'              => $agent->mehram_name ?? '-',
                'Airlines'          => $agent->pnr->flightdetails->flight_name ?? '-',
                'Mobile'            => $agent->contact ?? '-',
                'Sharing'           => $agent->sharingtype->name ?? '-',
                'Days'              => $agent->days ?? '-',
                'Ticket'            => $agent->adult + $agent->child + $agent->child_bed,
                'Visa'              => $agent->adult + $agent->child + $agent->child_bed,
                'Beds'              => $agent->adult + $agent->child,
                'Amount'            => $agent->city->tot_cost ?? '-',
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'Agents_Accounts_list.xlsx');
    }
    public function render()
    {
        return view('admin.reports.agent-account-report.agent-account-report-list-component', [
            'AgentAccounts' => $this->getAgentAccount()
        ]);
    }
}
