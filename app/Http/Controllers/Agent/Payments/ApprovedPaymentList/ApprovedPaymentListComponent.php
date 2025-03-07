<?php

namespace App\Http\Controllers\Agent\Payments\ApprovedPaymentList;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class ApprovedPaymentListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $search_receiptid, $booking_id, $company, $payments_modal_data, $booking_ids = [];
    public $tot_paid, $tot_cost, $balance, $search_start_date, $search_end_date;


    public function getApprovedPayment()
    {
        $agentId = auth()->user()->id;
        $this->booking_ids = Booking::where('agency_id', $agentId)->pluck('id')->toArray();
        $query = Payment::whereIn('booking_id', $this->booking_ids)
            ->approved() // Scope for 'approved' status
            ->SearchBookinId($this->booking_id)
            ->searchLike('receipt_id', $this->search_receiptid)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date)
            ->orderByDesc('id');

        // Get paginated data
        return $query->paginate($this->perPage);
    }

    public function filterPayments()
    {
        $this->resetPage();
    }

    public function getBookingContent($booking_id)
    {
        // $booking = Booking::where('booking_id', $booking_id)->first();
        $booking = Booking::whereId($booking_id)->first();



        $booking->load('agency', 'servicetype', 'city', 'pnr', 'package');
        $this->booking_modal_data = $booking;

        //  dd($this->booking_modal_data);
    }

    public function getPaymentContent(Payment $payment)
    {
        // dd('hi');
        $this->payments_modal_data = $payment;

        $booking_id = Booking::where('id', $payment->booking_id)->first();

        $this->reset(['tot_paid', 'balance']);
        if ($booking_id) {
            $all_payments = Payment::where('booking_id', $booking_id->id)->where('is_paid', 1)->where('payment_status', 1)->get();
            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('id', $booking_id->id)->value('tot_cost');
            $this->balance = $this->tot_cost - $this->tot_paid;
        }
    }

    public function exportToExcel()
    {

        ini_set('max_execution_time', '360');

        $resultArray = $this->payment->map(function ($payment, $index) {
            return [
                'Serial No.' => $index + 1,
                'Booking ID' => $payment->booking_id,
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

        $docName = "Approved Payments_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payments.approved-payment-list.approved-payment-list-component', [
            'ApprovedPayments' => $this->getApprovedPayment()
        ]);
    }
}
