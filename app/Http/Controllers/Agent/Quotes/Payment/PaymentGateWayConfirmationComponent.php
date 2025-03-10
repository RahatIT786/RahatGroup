<?php

namespace App\Http\Controllers\Agent\Quotes\Payment;

use App\Services\PaymentService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Booking;
use App\Models\Agency;

class PaymentGateWayConfirmationComponent extends Component
{
    use LivewireAlert;
    public $quote, $advance, $payment_amount = '', $confirmationChecked = false;
    public $data, $atomTokenId, $agent, $request;
    public function mount($quote_id)
    {


        $this->request = Booking::whereId($quote_id)->first();
        $this->agent = Agency::whereId(auth()->user()->id)->first();

        // $this->payment_amount = session()->get('payment_amount');
        $this->payment_amount = 10;

        $paymentService =  new PaymentService();
        $amount = $this->payment_amount;
        $user_email = $this->agent->email;
        $user_contact_number = $this->agent->mobile;
        $request_id = $this->request->request_id;
        $return_url = route('agent.payment.response'); // Make sure you have this route defined

        $this->data = $paymentService->createPayData($amount, $user_email, $user_contact_number, $return_url, $request_id);
        // d($this->data);
        $this->atomTokenId = $paymentService->createTokenId($this->data);
        // dd($this->atomTokenId );
       
     
       

        // session()->forget('payment_amount');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.payment.payment-gate-way-confirmation-component');
    }
}
