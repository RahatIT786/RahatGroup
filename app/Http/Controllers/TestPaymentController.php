<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestPaymentController extends Controller
{
    public function createPaymentLink(Request $request)
    {
        $merchantId = env('MERCHANT_ID');
        $password = env('MERCHANT_PASSWORD');
        $secretKey = env('MERCHANT_SECRET_KEY');

        $amount = "1.00";
        $merchantTxnId = "TXN" . time();
        $signature = hash_hmac('sha512', $merchantId . $password . $amount . $merchantTxnId, $secretKey);

        $response = Http::post('https://payment1.atomtech.in/ots/aipay/auth/createPaymentLink', [
            "merchantId" => $merchantId,
            "password" => $password,
            "amount" => $amount,
            "merchantTxnId" => $merchantTxnId,
            "customerName" => "John Doe",
            "customerEmail" => "john@example.com",
            "customerMobile" => "9876543210",
            "returnUrl" => "/payment-success",
            "signature" => $signature
        ]);

        return $response->json();
    }




    public function resendPaymentLink($invoiceNo)
{
    $merchantId = env('MERCHANT_ID');
    $password = env('MERCHANT_PASSWORD');
    $secretKey = env('MERCHANT_SECRET_KEY');

    $signature = hash_hmac('sha512', $merchantId . $password . $invoiceNo, $secretKey);

    $response = Http::post('https://payment1.atomtech.in/ots/aipay/auth/resendPaymentLink', [
        "merchantId" => $merchantId,
        "password" => $password,
        "invoiceNo" => $invoiceNo,
        "signature" => $signature
    ]);

    return $response->json();
}

public function cancelPaymentLink($invoiceNo)
{
    $merchantId = env('MERCHANT_ID');
    $password = env('MERCHANT_PASSWORD');
    $secretKey = env('MERCHANT_SECRET_KEY');

    $signature = hash_hmac('sha512', $merchantId . $password . $invoiceNo, $secretKey);

    $response = Http::post('https://api.paymentprovider.com/cancelPaymentLink', [
        "merchantId" => $merchantId,
        "password" => $password,
        "invoiceNo" => $invoiceNo,
        "signature" => $signature
    ]);

    return $response->json();
}


public function paymentSuccess(Request $request)
{
    $txnId = $request->input('merchantTxnId');
    $status = $request->input('status'); // success or failed

    if ($status == "success") {
        // Update order status in database
    }

    return view('payment-status', compact('status'));
}




}
