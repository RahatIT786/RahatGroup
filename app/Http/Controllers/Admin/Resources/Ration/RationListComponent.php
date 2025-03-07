<?php

namespace App\Http\Controllers\Admin\Resources\Ration;

use App\Models\Ration;
use App\Models\RationDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;

class RationListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $flightMaster = null, $serialNumber, $rationId, $modalData = null, $search_flight, $search_flight_code, $Id, $rationDetailExcel, $rationDataExcel, $search_title;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getRationData()
    {
        return Ration::query()
            ->desc()
            ->with('rationdetail')
            ->searchLike('ration_title', $this->search_title)
            ->paginate($this->perPage);
    }
    public function filterRation()
    {
        $this->resetPage();
    }

    public function toggleStatus(Ration $ration)
    {
        $this->rationId = $ration->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $rationData = Ration::whereId($this->rationId);
        $rationData->update(['is_active' => !$rationData->first()->is_active]);
        $this->alert('success', 'Status changed successfully');
    }

    public function isDelete(Ration $ration)
    {
        $this->Id = $ration->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $visaData = Ration::whereId($this->Id);
        $visaData->delete();
        $this->alert('success', 'Deleted successfully');
    }

    public function downloadInvoice($rationId)
    {
        // Retrieve data
        $rationData = Ration::find($rationId);
        $rationDetail = RationDetails::where('ration_id', $rationData->id)->with('ration', 'city')->get();
        if (!$rationData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'rationData' => $rationData,
            'rationDetail' => $rationDetail,
        ];
        $pdf = Pdf::loadView('admin.resources.ration.ration_pdf', $data);
        $docName = "Ration_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function exportToExcel($rationId)
    {
        // Fetch the ration data
        $this->rationDataExcel = Ration::find($rationId);
        $this->rationDetailExcel = RationDetails::where('ration_id', $this->rationDataExcel->id)
            ->with('ration', 'city')
            ->get();

        // Initialize the counter for serial numbers
        $serialNumber = 1;

        // Map the ration details to the result array
        $resultArray = $this->rationDetailExcel->map(function ($rationDetailExcel) use (&$serialNumber) {
            return [
                'SL No'        => $serialNumber++,
                'Item Name'    => $rationDetailExcel->ration->ration_title,
                'Description'  => $rationDetailExcel->description ?? '-',
                'City Name'    => $rationDetailExcel->city->city_name ?? '-',
                'Weight'       => $rationDetailExcel->weight ?? '-',
                'Rate'         => $rationDetailExcel->rate ?? '-',
                'Total'        => $rationDetailExcel->total_rate ?? '-',
            ];
        })->toArray();

        // Calculate the grand total of the total_rate
        $grandTotal = $this->rationDetailExcel->sum('total_rate');

        // Append the grand total row to the result array
        $resultArray[] = [
            'SL No'        => '',
            'Item Name'    => '',
            'Description'  => '',
            'City Name'    => '',
            'Weight'       => '',
            'Rate'         => 'Grand Total',
            'Total'        => $grandTotal,
        ];
        // Export the array to Excel
        return Helper::exportToExcel($resultArray, 'All Ration.xlsx');
    }


    public function render()
    {
        return view('admin.resources.ration.ration-list-component', [
            'rationData' => $this->getRationData(),
        ]);
    }
}
