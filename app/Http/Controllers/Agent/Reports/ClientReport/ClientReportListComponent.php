<?php

namespace App\Http\Controllers\Agent\Reports\ClientReport;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Agent;
use App\Models\Payment;
use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;



class ClientReportListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getclientReport()
    {
        $agentId =  auth()->user()->id;

        $bookings = Booking::with(['agency', 'payment', 'serviceType'])
            ->desc()
            ->where('agency_id', $agentId)
            ->approved()
            ->PaymentAmountSum()
            ->searchLike('booking_id', $this->booking_id)
            ->paginate($this->perPage);

        return $bookings;
    }
    // public function downloadReport($reportId)
    // {

    //     $clientData = Payment::with('booking')->find($reportId);

    //     // if (!$clientData) {
    //     //     return response()->json(['error' => 'not found'], 404);
    //     // }
    //     $clientData = [
    //         'booking_id' => $clientData->booking->booking_id ?? '',
    //         'agency' => $clientData->booking->agency->agency_name ?? '',
    //         'city' => $clientData->booking->agency->city ?? '',
    //         'agency_tel' => $clientData->booking->agency->mobile ?? '',
    //         'servicetype' => $clientData->booking->servicetype->name ?? '',
    //         'package_name' => $clientData->booking->package_name ?? '',
    //         'package_type' => $clientData->booking->package_type ?? '',
    //         'sharingtype' => $clientData->booking->sharingtype->name ?? '',
    //         'travel_date' => $clientData->booking->travel_date ?? '',
    //         'tot_cost' => $clientData->booking->tot_cost ?? '',
    //         'transaction_date' => $clientData->booking->txn_date ?? '',
    //         'receipt_id' => $clientData->receipt_id ?? '',
    //         'deposite_type' => $clientData->deposite_type ?? '',
    //         'amount' => $clientData->amount ?? '',
    //     ];

    //     // $pdf = PDF::loadView('agent.reports.client-report.client-report-pdf-component');
    //     // return $pdf->download('clientReports.pdf');

    //     // $viewdata = [
    //     //     'clientData' => $data,
    //     // ];

    //     $pdf = Pdf::loadView('agent.reports.client-report.client-report-pdf-component', ['clientData' => $clientData]);
    //     $docName = "clientReports.pdf";
    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf->stream();
    //     }, $docName);
    // }
    public function downloadReport($reportId)
    {
        
        // $clientData = Payment::with('booking.agency', 'booking.servicetype', 'booking.sharingtype', 'booking.payment')->find($reportId);
        $clientData = Payment::with('booking.agency', 'booking.servicetype', 'booking.sharingtype', 'booking.payment')->where('booking_id',$reportId)->first();
        
        if (!$clientData) {
            return response()->json(['error' => 'Not found'], 404);
        }

        $data = [
            'clientData' => $clientData,
        ];

        $pdf = Pdf::loadView('agent.reports.client-report.client-report-pdf-component', $data);
        $docName = "clientReports.pdf";

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function filterReport()
    {
        $this->resetPage();
    }
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.reports.client-report.client-report-list-component', [
            'clientReports' => $this->getclientReport()
        ]);
    }
}
