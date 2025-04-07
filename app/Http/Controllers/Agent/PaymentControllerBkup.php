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
        if($jsonData['status'] == 'success'){
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
    
            $request->update([
                'booking_id' => $request->request_id,
                'booking_status' => 1
            ]);
    
            $count_payments = Payment::where('booking_id', $request->id)->get();
           
    
            if (count($count_payments) == 1 && $count_payments[0]->amount > 0.98 * $request->tot_cost) {
               
                $payment_difference = $request->tot_cost - $count_payments[0]->amount;
               
                $full_payment = $request->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1, 'full_payment_discount' => $payment_difference]);
                $seats = Pnr::whereId($request->pnr_id)->first();
                $avai_seats = $seats->avai_seats;
                $tot_pax = $request->adult + $request->child_bed + $request->child;
    
                $updated_avai_seats = $avai_seats - $tot_pax;
                $seats->update([
                    'avai_seats' => $updated_avai_seats
                ]);
            }
    
            if (count($count_payments) > 1 ) {
                $totalAmount = $count_payments->sum('amount');
                if($totalAmount > 0.98 * $request->tot_cost){

                    $request->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1]);
                   
                }   
            }
    
            if (count($count_payments) == 1 && (($request->service_type == 2 && $request->package->umrah_type == 1) || $request->service_type == 20) && $$full_payment) {
            // if (count($count_payments) == 1 && $request->service_type == 2) {
                $seats = Pnr::whereId($request->pnr_id)->first();
                $avai_seats = $seats->avai_seats;
                $tot_pax = $request->adult + $request->child_bed + $request->child;
    
                $updated_avai_seats = $avai_seats - $tot_pax;
                $seats->update([
                    'avai_seats' => $updated_avai_seats
                ]);
            }
    
          
            return redirect()->route('agent.payment.response.view')->with([
                'booking_id' => $request->booking_id,
                'txn_id' => $jsonData['transaction_id'],
                'order_id' => $receipt_id,
                'paid_amount' => $jsonData['amount'],
                'status' => $jsonData['status']
            ]);
        }else{
            return redirect()->route('agent.payment.response.view');
        }
       

    }
}
