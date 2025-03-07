<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Agency;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Pnr;

class PaymentController extends Controller
{
    use LivewireAlert;
    protected $paymentService;

    public function agentPaymentResponse(Request $request)
    {
        $this->paymentService = new PaymentService();
        $jsonData = $this->paymentService->parseResponse($request->encData);
       
        $agency = Agency::where('email', $jsonData['customer_email'])->first();

        if ($agency) {
            Auth::guard('agent')->login($agency);
        }

        $request = Booking::where('request_id', $jsonData['request_id'])->first();

        $last_record = Payment::withTrashed()->orderBy('receipt_id', 'desc')->first();

        if ($last_record) {
            $receipt_id = $last_record->receipt_id + 1;
        } else {
            $receipt_id = 30000;
        }

        Payment::create([
            'booking_id' => $request->id,
            'receipt_id' => $receipt_id,
            'deposite_type' => 'Online',
            'amount' => $jsonData['amount'],
            'company' => '',
            'bank_name' => $jsonData['bank_name'],
            'txn_id' => $jsonData['transaction_id'],
            'txn_date' => $jsonData['transaction_date'],
            'bank_account_no' => '',
            'personal_name' => $agency->owner_name,
            'comment' => '',
            'payment_status' => 1,
            'is_paid' => 1,
        ]);


        $last_record = Booking::withTrashed()->where('booking_id', '!=', null)->orderBy('booking_id', 'desc')->first();

        if ($last_record) {
            $booking_id = $last_record->booking_id + 1;
        } else {
            $booking_id = 10000;
        }

        $request->update([
            'booking_id' => $booking_id,
            'booking_status' => 1
        ]);

        $count_payments = Payment::where('booking_id', $request->id)->get();
       

        if (count($count_payments) == 1 && $count_payments[0]->amount > 0.98 * $request->tot_cost) {
           
            $payment_difference = $request->tot_cost - $count_payments[0]->amount;
           
            $request->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1, 'full_payment_discount' => $payment_difference]);
        }


        if (count($count_payments) == 1 && $request->service_type == 2) {
            $seats = Pnr::whereId($request->pnr_id)->first();
            $avai_seats = $seats->avai_seats;
            $tot_pax = $request->adult + $request->child_bed + $request->child;

            $updated_avai_seats = $avai_seats - $tot_pax;
            $seats->update([
                'avai_seats' => $updated_avai_seats
            ]);
        }

        // $this->alert('success', 'Payment Successful');
        return redirect()->route('agent.quotes.index')->with([
            'booking_id' => $request->id,
            'txn_id' => $jsonData['transaction_id'],
        ]);

    }
}
