<?php

namespace App\Http\Controllers\Admin\Download\Invoice;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Agency;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use DB;

use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public function getInvoice()
    {
        $records = Booking::with('payment', 'agency')
            ->Approved()
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->paymentAmountSum()
            ->orderByDesc('id')
            ->get();

        $filteredRecords = $records->filter(function ($compare) {
            return $compare->tot_cost <= $compare->payment_sum_amount + $compare->full_payment_discount;;
        });
        $page = request()->get('page', 1); // Get the current page number from the request
        $paginatedRecords = new \Illuminate\Pagination\LengthAwarePaginator(
            $filteredRecords->forPage($page, $this->perPage),
            $filteredRecords->count(),
            $this->perPage,
            $page,
            ['path' => request()->url()]
        );

        return $paginatedRecords;
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function downloadInvoice($invoiceId)
    {

        // Retrieve exam data
        $invoiceData = Booking::find($invoiceId);

        $payment_id_array = Payment::where('booking_id', $invoiceId)->pluck('receipt_id')->toArray();

        $payment_ids = implode(',', $payment_id_array);


        if (!$invoiceData) {
            return response()->json(['error' => 'not found'], 404);
        }
        // Prepare data for the PDF view
        $data = [
            'agency' => $invoiceData->agency->agency_name ?? '',
            'agent_name' => $invoiceData->agency->owner_name ?? '',
            'agency_mail' => $invoiceData->agency->email ?? '',
            'agency_website' => $invoiceData->agency->website ?? '',
            'agency_tel' => $invoiceData->agency->mobile ?? '',
            'agency_address' => $invoiceData->agency->address ?? '',
            'meheram_name' => $invoiceData->mehram_name ?? '',
            'meheram_address' => $invoiceData->address ?? '',
            'meheram_contact' => $invoiceData->contact ?? '',
            'meheram_email' => $invoiceData->email_id ?? '',
            'travel_date' => $invoiceData->pnr->dept_date ?? '',
            'total_pax' => $invoiceData->adult + $invoiceData->child + $invoiceData->child_bed + $invoiceData->infant ?? '',
            'adult' => $invoiceData->adult ?? '',
            'children' => $invoiceData->child + $invoiceData->child_bed ?? '',
            'infant' => $invoiceData->infant ?? '',
            'date' => $invoiceData->created_at ?? '',
            'booking_id' => $invoiceData->booking_id ?? '',
            'total_cost' => $invoiceData->tot_cost ?? '',
            'package_name' => $invoiceData->package->name ?? '',
            'package_type' => $invoiceData->packagetype->package_type ?? '',
            'sharingtype' => $invoiceData->sharingtype->name ?? '',
            'payment_ids' => $payment_ids,
            'logo' => $invoiceData->agency->company_logo ?? null,
        ];
        // dd($data);

        $pdf = Pdf::loadView('admin.download.invoice.pdf.invoice-pdf-generator-component', $data);

        // Stream the PDF for download
        return $pdf->download('document.pdf');
    }

    public function render()
    {
        return view('admin.download.invoice.invoice-list-component', [
            'Invoices' => $this->getInvoice()
        ]);
    }
}
