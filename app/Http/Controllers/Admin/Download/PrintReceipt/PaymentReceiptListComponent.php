<?php

namespace App\Http\Controllers\Admin\Download\PrintReceipt;

use App\Models\Payment;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentReceiptListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $currentSegment, $search_booking_id, $search_receipt_id, $perPage = 10, $search_start_date;
    public function getPaymentReceipt()
    {

        // $abc = Payment::query()->with('booking')
        // ->SearchLikeInRelation('booking.booking_id', $this->search_booking_id)
        // ->searchLike('receipt_id', $this->search_receipt_id)
        // ->searchLike('txn_date', $this->search_start_date)
        // ->desc()->get();

        // foreach($abc as $a){
        //     echo '<pre>';
        //     print_r($a->booking. '\n');
        // }
        // exit();

        return Payment::query()->with('booking')
            ->SearchLikeInRelation('booking.booking_id', $this->search_booking_id)
            ->searchLike('receipt_id', $this->search_receipt_id)
            ->searchLike('txn_date', $this->search_start_date)
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function downloadReceipt($receiptId)
    {
        // dd($receiptId);
        // Retrieve exam data
        $PaymentData = Payment::with('booking')->find($receiptId);
        if (!$PaymentData) {
            return response()->json(['error' => 'not found'], 404);
        }
        // dd($PaymentData->booking->agency->agency_name);
        // Prepare data for the PDF view
        $data = [
            'agency' => $PaymentData->booking->agency->agency_name ?? '',
            'agency_mail' => $PaymentData->booking->agency->email ?? '',
            'agency_website' => $PaymentData->booking->agency->website ?? '',
            'agency_tel' => $PaymentData->booking->agency->mobile ?? '',
            'agency_address' => $PaymentData->booking->agency->address ?? '',
            'transaction_date' => $PaymentData->txn_date ?? '',
            'booking_id' => $PaymentData->booking->booking_id ?? '',
            'receipt_id' => $PaymentData->receipt_id ?? '',
            'deposite_type' => $PaymentData->deposite_type ?? '',
            'amount' => $PaymentData->amount ?? '',
            'tnx_id' => $PaymentData->txn_id ?? '',
        ];
        $pdf = Pdf::loadView('admin.download.print-receipt.pdf.payment-receipt-pdf-generator-component', $data);
        $docName = "Print_Receipt_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }
    public function render()
    {
        return view('admin.download.print-receipt.payment-receipt-list-component', [
            'PaymentReceipt' => $this->getPaymentReceipt()
        ]);
    }
}
