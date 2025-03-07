<?php

namespace App\Http\Controllers\Agent\Quotes;

use App\Services\PaymentService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Booking;
use App\Models\Agency;
use App\Models\Payment;

class PaymentConfirmComponent extends Component
{
    use LivewireAlert;
    public $quote, $advance, $payment_amount = '', $full_payment_amount = '',$confirmationChecked = false;
    public $data, $atomTokenId, $agent, $payments, $balance,$custom_amount;

    private $paymentService;

    public function mount($quote_id)
    {
        
        $this->quote = Booking::whereId($quote_id)->first();
        $paid_amount = Payment::where('booking_id', $this->quote->id)
            ->where('is_paid', '1')
            ->where('payment_status', '1')
            ->sum('amount');

        
        if ($paid_amount) {
            $this->balance = $this->quote->tot_cost - $paid_amount;

        } else {
            $this->balance = $this->quote->tot_cost;
        }

        $this->agent = Agency::whereId(auth()->user()->id)->first();

        $this->advance = $this->quote->tot_cost / 4;
       

        //Payment Gateway

    }
    public function checked()
    {

    }
    public function proceed($paymentType,$quote_id)
    {
       
        $this->payment_amount = $this->payment_amount != "" && $this->payment_amount > 0 ? (float) $this->payment_amount: "";
        // dd($paymentType,$quote_id,$this->payment_amount,$this->custom_amount);
        if($this->quote->tot_cost == $this->payment_amount){
           
            $this->full_payment_amount = $this->quote->tot_cost;
            $onePercentValue = ($this->quote->tot_cost * 1) / 100;
            
            $this->full_payment_amount = $this->payment_amount - $onePercentValue;
            // $this->reset(['payment_amount']);
            session()->put('payment_amount', $this->full_payment_amount);
        }else {
            
            if($this->payment_amount == 0 || $this->payment_amount == null){
                session()->put('payment_amount', $this->custom_amount);
            }else{
                $this->custom_amount = null;
                // $this->reset(['full_payment_amount']);
            session()->put('payment_amount', $this->payment_amount);
            }
            
        }
     
        if($this->custom_amount == null){
            $validated = $this->validate([
                'payment_amount' => 'required',
            ], [
                'payment_amount.required' => 'Please select an amount',
               
            ]);
        }else{
            $validated = $this->validate([
                'custom_amount' => 'required',
            ], [
                'custom_amount.required' => 'Please select an amount',
               
            ]); 
        }
       
        if($paymentType =='Offline'){
            return redirect()->route('agent.quotes.offline-payment', ['quote_id' => $quote_id]);
        }else if($paymentType =='paymentGateway'){
            return redirect()->route('agent.quotes.payment-gateway', ['quote_id' => $quote_id]);
        }

    }

    public function changes()
    {

    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.payment-confirm-component');
    }
}
