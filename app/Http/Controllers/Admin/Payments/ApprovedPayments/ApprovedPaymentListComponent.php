<?php

namespace App\Http\Controllers\Admin\Payments\ApprovedPayments;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class ApprovedPaymentListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmApprove'];
    public $payment_id, $Approved_Payments,$currentSegment, $search_booking_id, $search_receipt_id, $search_txn_id, $search_start_date, $payments_modal_data, $tot_cost, $total_payment,
        $search_end_date, $search_name, $perPage = 10,$booking_modal_data,$tot_paid,$balance;
    public function getApprovedPayment()
    {

        $this->Approved_Payments =  Payment::with('booking')
                                    ->approved()
                                    ->where('deposite_type', 'online') // Add this condition
                                    ->searchLike('booking_id', $this->search_booking_id)
                                    ->searchLike('receipt_id', $this->search_receipt_id)
                                    ->searchLike('txn_id', $this->search_txn_id)
                                    ->searchTransactionDate($this->search_start_date, $this->search_end_date)
                                    ->searchAgent($this->search_name)
                                    ->orderByDesc('id')
                                    ->get();

        // dd($this->Approved_Payments[0]);

        return Payment::with('booking')
            ->approved()
            ->where('deposite_type', 'online') // Add this condition
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('receipt_id', $this->search_receipt_id)
            ->searchLike('txn_id', $this->search_txn_id)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date)
            ->searchAgent($this->search_name)
            ->Desc()
            ->paginate($this->perPage);
    }
    public function filterPayments()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    // public function getBookingContent($booking_id)
    // {

    //     $booking = Booking::where('booking_id', $booking_id)->first();

    //     $booking->load('agency', 'servicetype','city','pnr');
    //     $this->booking_modal_data = $booking;

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


    public function isDelete(Payment $payment)
    {
        $this->payment_id = $payment->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $paymentData = Payment::whereId($this->payment_id)->first();
        $bookingData = Booking::whereId('booking_id', $paymentData->booking_id)->first();

        if ($bookingData && $paymentData->payment_status == '1') {
            $bookingData->update(['is_paid' => 0]);
        }

        if ($paymentData) {
            $paymentData->delete();
            $this->alert('success', 'Deleted successfully');
            // $this->render();
        } else {
            $this->alert('error', 'Record not found');
            // $this->render();
        }
    }

    public function exportToExcel()
    {
        ini_set('max_execution_time', 600);
        $resultArray = $this->Approved_Payments->map(function($payment){
            return  [
                'Serial No.'            => $payment->id,
                'Booking ID'            => $payment->booking_id,
                'Agency Name'           => $payment->booking->agency->agency_name ?? '-',
                'Receipt ID'            => $payment->receipt_id,
                'Deposite Type'         => $payment->deposite_type,
                'Amount'                => $payment->amount,
                'Company Name'          => $payment->company,
                'Transaction Date'      => Helper::formatCarbonDate($payment->txn_date),
                'Bank Name'             => $payment->bank_name,
                'Status' => $payment->payment_status == 0 ? 'Pending' :
                            ($payment->payment_status == 1 ? 'Approved' :
                            ($payment->payment_status == 2 ? 'Unclear' :
                            ($payment->payment_status == 3 ? 'Bounce' : 'Not received')))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'Approved_Payments.xlsx');
    }
    public function render()
    {
        return view('admin.payments.approved-payments.approved-payment-list-component', [
            'ApprovedPayments' => $this->getApprovedPayment()
        ]);
    }
}
