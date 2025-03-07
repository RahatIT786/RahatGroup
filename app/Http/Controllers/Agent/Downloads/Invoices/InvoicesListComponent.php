<?php

namespace App\Http\Controllers\Agent\Downloads\Invoices;

use App\Models\Booking;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $currentSegment, $search_name;
    public function getmanageInvoice()
    {
        $records = Booking::with('payment', 'agency')
            ->where('agency_id', auth()->user()->id)
            ->Approved()
            ->searchLike('booking_id', $this->booking_id)
            ->searchLike('mehram_name', $this->search_name)
            ->paymentAmountSum()
            ->orderByDesc('id')
            ->get();
        // dd($records);
        $filteredRecords = $records->filter(function ($compare) {
            return $compare->tot_cost <= $compare->payment_sum_amount + $compare->full_payment_discount;;
        });

        // dd($filteredRecords);

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

    // public function downloadInvoice($Invoiceid)
    // {

    //     $invoiceData = Booking::where('id',$Invoiceid)->with('payment')->first();

    //     $payment_id_array = Payment::where('booking_id', $Invoiceid)->pluck('receipt_id')->toArray();

    //     $payment_ids = implode(',',$payment_id_array );
    //     //  dd($invoiceData->payment);
    //     if (!$invoiceData) {
    //         return response()->json(['error' => 'not found'], 404);
    //     }

    //     $data = [
    //         'agency' => $invoiceData->agency->agency_name ?? '',
    //         'agency_mail' => $invoiceData->agency->email ?? '',
    //         'agency_website' => $invoiceData->agency->website ?? '',
    //         'agency_tel' => $invoiceData->agency->mobile ?? '',
    //         'agency_address' => $invoiceData->agency->address ?? '',
    //         'meheram_name' => $invoiceData->mehram_name ?? '',
    //         'meheram_address' => $invoiceData->address ?? '',
    //         'meheram_contact' => $invoiceData->contact ?? '',
    //         'meheram_email' => $invoiceData->email_id ?? '',
    //         'travel_date' => $invoiceData->pnr->dept_date ?? '',
    //         'total_pax' => $invoiceData->adult + $invoiceData->child + $invoiceData->child_bed + $invoiceData->infant ?? '',
    //         'adult' => $invoiceData->adult ?? '',
    //         'children' => $invoiceData->child + $invoiceData->child_bed ?? '',
    //         'infant' => $invoiceData->infant ?? '',
    //         'date' => $invoiceData->created_at ?? '',
    //         'booking_id' => $invoiceData->booking_id ?? '',
    //         'total_cost' => $invoiceData->tot_cost ?? '',
    //         'package_name' => $invoiceData->package_name ?? '',
    //         'package_type' => $invoiceData->package_type ?? '',
    //         'sharingtype' => $invoiceData->sharingtype->name ?? '',
    //         'payment_ids'   => $payment_ids,
    //         'logo'  => $invoiceData->agency->company_logo
    //     ];

    //     $pdf = Pdf::loadView('agent.downloads.invoices.invoice-pdf-component', $data);

    //     $docName = "Invoice" . time() . ".pdf";
    //     return response()->streamDownload(function () use ($pdf) {
    //         echo $pdf->stream();
    //     }, $docName);
    // }


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
            'logo'  => $invoiceData->agency->company_logo
        ];
        // dd($data);

        $pdf = Pdf::loadView('agent.downloads.invoices.invoice-pdf-component', $data);

        $docName = "Invoice" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.invoices.invoices-list-component', [
            'Invoices' => $this->getmanageInvoice()
        ]);
    }
}
