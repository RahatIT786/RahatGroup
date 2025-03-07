<?php

namespace App\Http\Controllers\Agent\Downloads\PrintReceipts;

use Livewire\Component;
//use App\Models\Booking;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintReceiptsListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $receipt_id, $payment;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getPrintReceipt()
    {
       
        // return Payment::query()
        //     ->where('booking_id', auth()->user()->id)
        //     ->searchLike('booking_id', $this->booking_id)
        //     ->searchLike('receipt_id', $this->receipt_id)
        //     ->desc()
        //     ->paginate($this->perPage);

        return Payment::query()->with('booking')
            ->whereHas('booking', function ($query) {
                $query->where('agency_id', auth()->user()->id);
            })
            ->SearchLikeInRelation('booking.booking_id', $this->booking_id)
            ->searchLike('receipt_id', $this->receipt_id)
            ->desc()
            ->paginate($this->perPage);
    }

    public function downloadReceipt($receiptId)
    {
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
            'booking_id' => $PaymentData->booking_id ?? '',
            'receipt_id' => $PaymentData->receipt_id ?? '',
            'deposite_type' => $PaymentData->deposite_type ?? '',
            'amount' => $PaymentData->amount ?? '',
            'tnx_id' => $PaymentData->txn_id ?? '',
        ];
        $pdf = Pdf::loadView('agent.downloads.print-receipts.print-receipt-pdf-component', $data);
        $docName = "Print_Receipt_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function filterBookings()
    {
        $this->resetPage();
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.downloads.print-receipts.print-receipts-list-component', [
            'PrintReceipts' => $this->getPrintReceipt()
        ]);
    }
}
