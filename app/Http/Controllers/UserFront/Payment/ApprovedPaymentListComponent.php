<?php

namespace App\Http\Controllers\UserFront\Payment;

use Livewire\Component;
use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class ApprovedPaymentListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $search_receiptid, $booking_id, $company, $payments_modal_data, $booking_ids = [];
    public $tot_paid, $tot_cost, $balance, $search_start_date, $search_end_date, $payment;

    public function getApprovedPayment()
    {
        $agentId =  auth()->user()->id;
        $all_bookings = Booking::where('user_type', $agentId)->get();

        foreach ($all_bookings as $booking) {
            array_push($this->booking_ids, $booking->id);
        }

        $query = Payment::whereIn('booking_id', $this->booking_ids)
            ->approved()
            ->SearchBookinId($this->booking_id)
            ->searchLike('booking_id', $this->booking_id)
            ->searchLike('receipt_id', $this->search_receiptid)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date);
        $this->payment = $query->get();
        // $this->bookingcount =  $query->count();
        return $query->paginate($this->perPage);
    }

    // public function getApprovedPayment()
    // {
    //     // $customerId =  auth()->user()->id;
    //     // $all_bookings = Booking::where('user_type', $customerId)->get();

    //     // foreach ($all_bookings as $booking) {
    //     //     array_push($this->booking_ids, $booking->booking_id);
    //     // }

    //     // $query = Payment::whereIn('booking_id', $this->booking_ids)
    //     //     ->approved()
    //     //     ->where('deposite_type', 'online')
    //     //     ->where('payment_status', 1)
    //     //     ->searchLike('booking_id', $this->booking_id)
    //     //     ->searchLike('receipt_id', $this->search_receiptid)
    //     //     ->searchTransactionDate($this->search_start_date, $this->search_end_date);
    //     // $this->payment = $query->get();

    //     // return $query->paginate($this->perPage);

    //     $this->Approved_Payments = Payment::with('booking')
    //         ->approved()
    //         ->searchLike('booking_id', $this->booking_id)
    //         ->searchLike('receipt_id', $this->search_receiptid)
    //         ->searchTransactionDate($this->search_start_date, $this->search_end_date)
    //         ->orderByDesc('id')
    //         ->paginate($this->perPage);

    //     return $this->Approved_Payments; // Return paginated results
    // }

    public function filterPayments()
    {
        $this->resetPage();
    }

    // public function getPaymentContent(Payment $payment)
    // {
    //      $this->payments_modal_data = $payment;
    //      $booking = Booking::where('booking_id',$payment->booking_id)->first();
    //      $this->tot_cost = $booking->tot_cost;

    //      if ($booking->id) {
    //         $all_payments = Payment::where('booking_id', $booking->booking_id)->where('payment_status',1)->get();
    //         $this->tot_paid = $all_payments->sum('amount');
    //         $this->tot_cost = Booking::where('booking_id', $booking->booking_id)->value('tot_cost');
    //         $this->balance = $this->tot_cost - $this->tot_paid;
    //     }

    // }
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
            $all_payments = Payment::where('booking_id', $booking_id->booking_id)->where('is_paid', 1)->where('payment_status', 1)->get();

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

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.payment.approved-payment-list-component', [
            'ApprovedPayments' => $this->getApprovedPayment()
        ]);
    }
}
