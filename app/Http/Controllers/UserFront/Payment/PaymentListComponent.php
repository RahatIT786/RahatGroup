<?php

namespace App\Http\Controllers\UserFront\Payment;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $payment, $perPage = 10, $booking_id, $payments_modal_data, $payment_id, $tot_cost, $search_start_date, $search_end_date, $search_receiptid, $booking_ids = [];
    public $tot_paid, $balance, $bookingcount;

    public function getPayment()
    {
        $customerId =  auth()->user()->id;
        $all_bookings = Booking::where('user_type', $customerId)->get();

        foreach ($all_bookings as $booking) {
            array_push($this->booking_ids, $booking->id);
        }

        $query = Payment::whereIn('booking_id', $this->booking_ids)
            ->desc()
            ->SearchBookinId($this->booking_id)
            ->searchLike('receipt_id', $this->search_receiptid)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date);
        $this->payment = $query->get();
        $this->bookingcount =  $query->count();
        return $query->paginate($this->perPage);
    }

    public function filterPayments()
    {
        $this->resetPage();
    }

    public function getPaymentContent(Payment $payment)
    {
        $this->payments_modal_data = $payment;
        $booking = Booking::whereId($payment->booking_id)->first();
        $this->tot_cost = $booking->tot_cost;

        if ($booking->id) {
            $all_payments = Payment::where('booking_id', $booking->id)->where('payment_status', 1)->get();
            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('booking_id', $booking->booking_id)->value('tot_cost');
            $this->balance = $this->tot_cost - $this->tot_paid;
        }
    }

    public function exportToExcel()
    {

        ini_set('max_execution_time', '360');

        $resultArray = $this->payment->map(function ($payment, $index) {
            return [
                'Serial No.' => $index + 1,
                'Booking ID' => $payment->booking->booking_id,
                'Agency Name' => $payment->booking->agency->agency_name ?? '-',
                'Receipt ID' => $payment->receipt_id,
                'Deposite Type' => $payment->deposite_type,
                'Amount' => $payment->amount,
                'Company Name' => $payment->company,
                'Transaction Date' => date('d-M-Y', strtotime($payment->txn_date)),
                'Bank Name' => $payment->bank_name,
                'Status' => $payment->payment_status == 0 ? 'Pending' : ($payment->payment_status == 1 ? 'Approved' : ($payment->payment_status == 2 ? 'Unclear' : ($payment->payment_status == 3 ? 'Bounce' : 'Not received')))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'Payments.xlsx');
    }

    public function download()
    {
        ini_set('max_execution_time', '360');

        $data = [
            'Payment_Data' => $this->payment
        ];

        $pdf = Pdf::loadView('admin.payments.all-payments-pdf', $data);

        $docName = "All Payments_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
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
        $pdf = Pdf::loadView('agent.payments.all-payment-lists.payment-receipt-pdf-component', $data);
        $docName = "Payment_Receipt_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.payment.payment-list-component', [
            'payments' => $this->getPayment()
        ]);
    }
}
