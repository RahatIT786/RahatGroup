<?php

namespace App\Http\Controllers\Admin\Download\Invoice;

use App\Models\Booking;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public function getInvoice()
    {
        return Booking::query()
            ->with('agency', 'servicetype') // Load the agent relationship
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

     public function downloadInvoice($invoiceId)
    {
        //  dd($invoiceId);
        // Retrieve exam data
        $invoiceData = Booking::find($invoiceId);
       
        if (!$invoiceData) {
            return response()->json(['error' => 'not found'], 404);
        }
        // Prepare data for the PDF view
        $data = [
            'agency' => $invoiceData->agency->agency_name ?? '',
            'agency_mail' => $invoiceData->agency->email ?? '',
            'agency_website' => $invoiceData->agency->website ?? '',
            'agency_tel' => $invoiceData->agency->mobile ?? '',
            'agency_address' => $invoiceData->agency->address ?? '',
            'meheram_name' => $invoiceData->mehram_name ?? '',
            'meheram_address' => $invoiceData->address ?? '',
            'meheram_contact' => $invoiceData->contact ?? '',
            'meheram_email' => $invoiceData->email_id ?? '',
            'travel_date' => $invoiceData->pnr->dept_date,
            'total_pax' => $invoiceData->adult + $invoiceData->child + $invoiceData->child_bed + $invoiceData->infant ?? '',
            'adult' => $invoiceData->adult ?? '',
            'children' => $invoiceData->child + $invoiceData->child_bed ?? '',
            'infant' => $invoiceData->infant ?? '',
            'date' => $invoiceData->created_at ?? '',
            'booking_id' => $invoiceData->booking_id ?? '',
            'total_cost' => $invoiceData->tot_cost ?? '',
            'package_name' => $invoiceData->package_name ?? '',
            'package_type' => $invoiceData->package_type ?? '',
            'sharingtype' => $invoiceData->sharingtype->name ?? '',
        ];
        //   dd($data);
        // Load the view and generate the PDF
        
        // resources\views\admin\download\invoice\invoice-pdf.blade.php
        // Stream the PDF for download


        // $pdf = \PDF::loadView('admin.download.invoice.invoice-pdf', $data);
        // return $pdf->download(' Invoice.pdf');

        // $pdf = Pdf::loadView('admin.download.invoice.invoice-pdf');
        // return view('invoice');
        $pdf = Pdf::loadView('invoice');
        return $pdf->download('invoice.pdf');
    
    }
    public function render()
    {
        return view('admin.download.invoice.invoice-list-component', [
            'Incoives' => $this->getInvoice()
        ]);
    }
}
