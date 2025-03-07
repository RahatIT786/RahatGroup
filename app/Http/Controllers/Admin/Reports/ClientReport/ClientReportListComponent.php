<?php

namespace App\Http\Controllers\Admin\Reports\ClientReport;

use App\Models\Booking;
use App\Models\Payment;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientReportListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $perPage = 10, $bookingId;


    public function getClientReport()
    {
        // dd($this->search_booking_id);
        return Booking::query()
            ->with('agency', 'servicetype')
            ->searchLike('booking_id', $this->search_booking_id)
            ->whereNotNull('booking_id')
            ->where('is_paid', 0)
            ->orderBy('created_at', 'desc') // Adjust column_name as needed.
            ->paginate($this->perPage);
    }

    public function downloadReport($reportId)
    {
        $clientData = Booking::where('booking_id', $reportId)->with([
            'payment' => function ($query) {
                $query->approved();
            },
            'agency',
            'packagetype'
        ])->first();
        if (!$clientData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'clientData' => $clientData,
        ];
        $pdf = Pdf::loadView('admin.reports.client-report.client-report-pdf-component', $data);
        $docName = "Client_Report_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function render()
    {
        return view('admin.reports.client-report.client-report-list-component', [
            'ClientReport' => $this->getClientReport()
        ]);
    }
}
