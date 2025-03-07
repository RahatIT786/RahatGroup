<?php

namespace App\Http\Controllers\Agent\Quotes;

use App\Services\PaymentService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Agency;

class HajjQuoteDetailsComponent extends Component
{   
    use LivewireAlert;
    public $quote, $advance, $payment_amount = 0,$confirmationChecked = false;
    public $data,$atomTokenId,$agent,$payments;

    private $paymentService;

    public function mount($quote_id)
    {
       
        $this->quote = Booking::whereId($quote_id)->with('agency')->first();
        
        $this->agent = Agency::whereId(auth()->user()->id)->first(); 

        $this->advance =  $this->quote->tot_cost / 4;


        $this->payments = Payment::where('booking_id',$quote_id)->get();
         
        foreach($this->payments as $payment) {
          
           $this->payment_amount += $payment->amount;
        }
       
       
    } 
    public function checked()
    {
          
    }
    public function changes()
    {
       
       $this->payment_amount = (float) $this->payment_amount;

        // session()->put('payment_amount',$this->payment_amount);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.hajj-quote-details-component');
    }
}
