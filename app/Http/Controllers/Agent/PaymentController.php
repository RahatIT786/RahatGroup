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

    // ✅ Constructor injection of PaymentService
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function agentPaymentResponse(Request $request)
    {
        $paymentId = $request->razorpay_payment_id;

        if (!$paymentId) {
            return back()->with('error', 'Payment ID is missing!');
        }

        // ✅ Call parseResponse after the service is injected
        $jsonData = $this->paymentService->parseResponse($paymentId);

        if ($jsonData['status'] == 'success') {
         //  dd($jsonData['amount'],  $jsonData['bank_name'],  $jsonData['transaction_id'], $jsonData['customer_email']);
            $agency = Agency::where('email', $jsonData['customer_email'])->first();
            //dd( $agency);
            if ($agency) {
                Auth::guard('agent')->login($agency);
            }
           // dd($jsonData['request_id']);
            $booking = Booking::where('request_id', trim($jsonData['request_id']))->first();
           // dd($booking);
            $last_record = Payment::withTrashed()->orderBy('receipt_id', 'desc')->first();
            $receipt_id = $last_record ? $last_record->receipt_id + 1 : 30000;

            // dd($booking);
          //  dd($jsonData['request_id']);
            Payment::create([
                'booking_id' => $booking->id,
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
                'agent_id' => $agency->id,
            ]);

            $booking->update([
                'booking_id' => $booking->request_id,
                'booking_status' => 1,
            ]);

            $count_payments = Payment::where('booking_id', $booking->id)->get();
            $full_payment = false;
            if (
                count($count_payments) == 1 &&
                $count_payments[0]->amount > 0.98 * $booking->tot_cost
            ) {
                $payment_difference = $booking->tot_cost - $count_payments[0]->amount;

                $full_payment = $booking->update([
                    'is_paid' => 1,
                    'release_tkt' => 1,
                    'release_visa' => 1,
                    'full_payment_discount' => $payment_difference
                ]);

                $seats = Pnr::whereId($booking->pnr_id)->first();
                $updated_avai_seats = $seats->avai_seats - ($booking->adult + $booking->child_bed + $booking->child);
                $seats->update(['avai_seats' => $updated_avai_seats]);
            }

            if (count($count_payments) > 1) {
                $totalAmount = $count_payments->sum('amount');
                if ($totalAmount > 0.98 * $booking->tot_cost) {
                    $booking->update([
                        'is_paid' => 1,
                        'release_tkt' => 1,
                        'release_visa' => 1
                    ]);
                }
            }

            if (
                count($count_payments) == 1 &&
                (($booking->service_type == 2 && $booking->package->umrah_type == 1) || $booking->service_type == 20) &&
                $full_payment
            ) {
                $seats = Pnr::whereId($booking->pnr_id)->first();
                $updated_avai_seats = $seats->avai_seats - ($booking->adult + $booking->child_bed + $booking->child);
                $seats->update(['avai_seats' => $updated_avai_seats]);
            }

            return redirect()->route('agent.payment.response.view')->with([
                'booking_id' => $booking->booking_id,
                'txn_id' => $jsonData['transaction_id'],
                'order_id' => $receipt_id,
                'paid_amount' => $jsonData['amount'],
                'status' => $jsonData['status']
            ]);
        } else {
            return redirect()->route('agent.payment.response.view');
        }
    }
}
