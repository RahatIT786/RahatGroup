<?php

namespace App\Http\Controllers\Admin\Payments\PendingPayments;

use App\Helpers\Helper;
use App\Models\AdminSetting;
use App\Models\Pnr;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class PendingPaymentListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmApprove'];
    public $payment_id,$Pending_Payments, $currentSegment, $search_booking_id, $search_receipt_id, $search_txn_id, $search_start_date, $payments_modal_data, $tot_cost, $total_payment, $search_end_date, $search_name, $perPage = 10, $booking_modal_data,$tot_paid,$balance;
    public function getPendingPayments()
    {
        $this->Pending_Payments =  Payment::with('booking')
        ->pending()

        ->searchLike('booking_id', $this->search_booking_id)
        ->searchLike('receipt_id', $this->search_receipt_id)
        ->searchLike('txn_id', $this->search_txn_id)
        ->searchTransactionDate($this->search_start_date, $this->search_end_date)
        ->searchAgent($this->search_name)
        ->orderByDesc('id')
        ->get();

        return Payment::with('booking')
            ->pending()
            ->searchLike('booking_id', $this->search_booking_id)
            ->searchLike('receipt_id', $this->search_receipt_id)
            ->searchLike('txn_id', $this->search_txn_id)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date)
            ->searchAgent($this->search_name)
            ->orderByDesc('id')
            ->paginate($this->perPage);
    }
    public function filterPayments()
    {
        $this->resetPage(); // Reset pagination when the search term changes
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



    public function isApprove(Payment $payment)
    {

        $this->payment_id = $payment->id;
        $this->confirm('Are you sure to approve this payment?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmApprove',
        ]);
    }
    public function confirmApprove()
    {
        $paymentData = Payment::whereId($this->payment_id)->first();

        $lastestBooking = Booking::desc()->where('booking_id', '!=', '')->first();

        $bookingData = Booking::whereId($paymentData->booking_id)->first();

        $paid_amount = Payment::where('booking_id', $bookingData->id)
            ->where('is_paid', '1')
            ->where('payment_status', '1')
            ->sum('amount');

        if ($bookingData->tot_cost == $paid_amount) {
            $bookingData->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1]);

            $seats = Pnr::whereId($bookingData->pnr_id)->first();
            $avai_seats = $seats->avai_seats;
            $tot_pax = $bookingData->adult + $bookingData->child_bed + $bookingData->child;

            $updated_avai_seats = $avai_seats - $tot_pax;
            $seats->update([
                'avai_seats' => $updated_avai_seats
            ]);
        }

        if ($paymentData->update(['payment_status' => 1, 'is_paid' => 1,])) {

            // $bookingData->update(['booking_id' => $lastestBooking->booking_id + 1, 'booking_status' => 1]);
            $bookingData->update(['booking_status' => 1]);

            $count_paid_amount = Payment::where('booking_id', $bookingData->id)
                ->where('is_paid', '1')
                ->where('payment_status', '1')
                ->get();

            if (count($count_paid_amount) == 1 && $count_paid_amount[0]->amount > 0.98 * $bookingData->tot_cost) {
                $payment_difference = $bookingData->tot_cost - $paymentData->amount;
                $bookingData->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1, 'full_payment_discount' => $payment_difference]);

                $seats = Pnr::whereId($bookingData->pnr_id)->first();
                $avai_seats = $seats->avai_seats;
                $tot_pax = $bookingData->adult + $bookingData->child_bed + $bookingData->child;
    
                $updated_avai_seats = $avai_seats - $tot_pax;
                $seats->update([
                    'avai_seats' => $updated_avai_seats
                ]);
            }
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            // Mail::to($bookingData->agency->email)->cc($adminEmail)->send(new PaymentApprovedMail($paymentData, $bookingData));
            $this->alert('success', 'Payment Approved Successfully.');
        } else {
            $this->alert('error', 'Something went wrong.');
        }
    }



    public function exportToExcel()
    {
        $resultArray = $this->Pending_Payments->map(function($payment){
            return  [
                'Serial No.'            => $payment->id,
                'Booking ID'            => $payment->booking_id,
                'Agency Name'           => $payment->booking->agency->agency_name ?? '-',
                'Receipt ID'            => $payment->receipt_id,
                'Deposite Type'         => $payment->deposite_type,
                'Amount'                => $payment->amount,
                'Company Name'          => $payment->company,
                'Transaction Date'      => date('d-M-Y', strtotime($payment->txn_date)),
                'Bank Name'             => $payment->bank_name,
                'Status' => $payment->payment_status == 0 ? 'Pending' :
                            ($payment->payment_status == 1 ? 'Approved' :
                            ($payment->payment_status == 2 ? 'Unclear' :
                            ($payment->payment_status == 3 ? 'Bounce' : 'Not received')))
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'Pending_Payments.xlsx');
    }
    public function render()
    {
        return view('admin.payments.pending-payments.pending-payment-list-component', [
            'PendingPayments' => $this->getPendingPayments()
        ]);
    }
}
