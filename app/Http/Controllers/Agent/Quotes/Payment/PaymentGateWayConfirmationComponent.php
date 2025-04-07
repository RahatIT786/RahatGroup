<?php

namespace App\Http\Controllers\Agent\Quotes\Payment;

use App\Services\PaymentService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Agency;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PaymentGateWayConfirmationComponent extends Component
{
    public $payment_amount = 10;
    public $razorpayKey;
    public $razorpayOrderId;
    public $amountInPaise;
    public $agent, $request;

    public function mount($quote_id)
    {
        $this->request = Booking::findOrFail($quote_id);
        $this->agent = Agency::findOrFail(auth()->user()->id);

        //$this->payment_amount = session()->get('payment_amount');
        $this->payment_amount = 1;
        $this->amountInPaise = $this->payment_amount * 100;

        $paymentService =  new PaymentService();
        $amount = $this->payment_amount;
        $user_email = $this->agent->email;
        $user_contact_number = $this->agent->mobile;
        $request_id = $this->request->request_id;
        $return_url = route('agent.payment.response');

        // Razorpay keys from .env
        $this->razorpayKey = env('RAZORPAY_KEY');

        // Create Razorpay Order
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'RQ_' . uniqid(),
            'amount' => $this->amountInPaise,
            'currency' => 'INR'
        ]);

        $this->razorpayOrderId = $order['id'];

        try {
            $this->data = $paymentService->createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id, $order);
            Log::info('Payment Data:', $this->data);
        
            // $this->atomTokenId = $paymentService->createTokenId($this->data);
            // Log::info('Atom Token ID: ' . $this->atomTokenId);
        
        } catch (\Exception $e) {
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong. Please try again later.'], 500);
        }
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.payment.payment-gate-way-confirmation-component', [
            'razorpayOrderId' => $this->razorpayOrderId,
            'razorpayKey' => $this->razorpayKey,
            'amountInPaise' => $this->amountInPaise,
            'payment_amount' => $this->payment_amount,
            'agent' => $this->agent
        ]);
    }
}
