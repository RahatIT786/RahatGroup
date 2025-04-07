<?php

namespace App\Services;

use Razorpay\Api\Api;
use Illuminate\Support\Str;

class PaymentService
{
    protected $razorpay;
    protected $requestId;

    public function __construct()
    {
        $this->razorpay = new Api(
            config('gateway.razorpay.key'),
            config('gateway.razorpay.secret')
        );
    }

    /**
     * Create a new Razorpay order
     */
    public function createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id, $order)
    {
        $this->requestId = $request_id;
        session(['request_id' => $request_id]);
        $orderData = [
            'receipt' => Str::uuid(),
            'amount' => $amount * 100,
            'currency' => 'INR',
            'payment_capture' => 1,
            'notes' => [
                'email' => $user_email,
                'mobile' => $user_contact_number,
                'request_id' => $request_id
            ]
        ];
        
        return [
            'order_id' => $order['id'],
            'amount' => $amount,
            'currency' => 'INR',
            'email' => $user_email,
            'mobile' => $user_contact_number,
            'return_url' => $return_url
        ];
    }

    /**
     * Simulates parsing Razorpay webhook/payment data to match old Atom response format
     */
    public function parseResponse($razorpayPayment)
    {
       // dd($razorpayPayment);

       $requestId = session('request_id');
       //dd($requestId);
        // You should retrieve this using the payment ID
        $payment = $this->razorpay->payment->fetch($razorpayPayment);

        if ($payment && $payment['status'] === 'captured') {
            return [
                'status' => 'success',
                'transaction_id' => $payment['id'],
                'transaction_date' => $payment['created_at'] ? date('Y-m-d H:i:s', $payment['created_at']) : null,
                'amount' => $payment['amount'] / 100,
                'surcharge_amount' => 0,
                'total_amount' => $payment['amount'] / 100,
                'currency' => $payment['currency'],
                'customer_account_number' => null, // Razorpay does not provide this
                'client_code' => null, // Optional field
                'transaction_initiation_date' => null,
                'transaction_completion_date' => null,
                'bank_name' => $payment['bank'] ?? 'Razorpay',
                // 'card_type' => $payment['card'] ?? null,
                // 'scheme' => $payment['method'] ?? null,
                'response_message' => 'Payment captured successfully',
                'response_description' => 'Payment was successful through Razorpay',
                'customer_email' => $payment['email'],
                'customer_mobile' => $payment['contact'],
                'request_id' => $requestId ?? null
            ];
        }

        return [
            'status' => 'failed',
            'data' => $payment
        ];
    }
}
