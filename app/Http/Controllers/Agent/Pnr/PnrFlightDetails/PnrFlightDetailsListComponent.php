<?php

namespace App\Http\Controllers\Agent\Pnr\PnrFlightDetails;

use App\Models\Pnr;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class PnrFlightDetailsListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $allPnr, $itinerary_modal_data, $group_name, $search_city, $start_date, $end_date;
    public $flight_modal_data;

    public function getPnr()
    {
        return  Pnr::query()->where('seats' ,'>',0)
        ->where('dept_date', '>', Carbon::today())
            ->with('city', 'flight', 'package', 'departuresector', 'returnsector')
            ->searchLike('group_name', $this->group_name)
            ->searchCity($this->search_city)
            ->searchpnrDate($this->start_date, $this->end_date)
              ->orderBy('dept_date', 'asc') // Order by id in descending order
            ->paginate($this->perPage);
    }

    public function filterPnr()
    {
        // dd($this->end_date);
        $this->resetPage();
    }

    public function getItinerary(Pnr $pnr)
    {
        // dd($pnrdata);
        $this->itinerary_modal_data = $pnr;
    }

    public function getModalContent(Pnr $pnr)
    {
        // dd($pnr);
        $this->flight_modal_data = $pnr;
    }

    public function downloadPnr()
    {
        $pnr = Pnr::where('dept_date', '>', Carbon::today())->orderBy('dept_date', 'asc')->get();
        // dd($pnr);
        if (!$pnr) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'pnrData' => $pnr,
        ];
        $pdf = Pdf::loadView('agent.pnr.pnr-flight-details.pnr_pdf', $data);
        $docName = "PNR_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        // dd($this->getPnr()[0]->packages);
        return view('agent.pnr.pnr-flight-details.pnr-flight-details-list-component', [
            'pnrData' => $this->getPnr()
        ]);
    }
}
