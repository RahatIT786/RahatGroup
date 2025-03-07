<?php

namespace App\Http\Controllers\Agent\Bookings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Booking;
use App\Models\Agency;
use App\Models\Payment;

class AdditionalPaymentsComponent extends Component
{   
    use LivewireAlert;
    public $quote, $advance, $payment_amount = '', $confirmationChecked = false;
    public $data, $atomTokenId, $agent, $payments, $balance;
    private $paymentService;

    public function mount($booking_id)
    {
       
        $this->quote = Booking::whereId($booking_id)->first();
        
        $paid_amount = Payment::where('booking_id', $this->quote->id)
            ->where('is_paid', '1')
            ->where('payment_status', '1')
            ->sum('amount');

        
        if ($paid_amount) {
            $this->balance = $this->quote->tot_cost - $paid_amount - $this->quote->full_payment_discount ?? 0;

        } else {
            $this->balance = $this->quote->tot_cost;
        }

        $this->agent = Agency::whereId(auth()->user()->id)->first();

        // $this->advance = $this->quote->tot_cost / 4;
        // dd($this->quote);

        //Payment Gateway

    }
    public function checked()
    {

    }
    public function proceed($paymentType,$quote_id)
    {
        //   dd($paymentType,$quote_id,$this->payment_amount);

        $validated = $this->validate([
            'payment_amount' => ['required', 'numeric', 'max:' . $this->balance],
        ], [
            'payment_amount.required' => 'Please select an amount',
           
        ]);
        
        if($paymentType =='Offline'){
            return redirect()->route('agent.quotes.offline-payment', ['quote_id' => $quote_id]);
        }else if($paymentType =='paymentGateway'){
            return redirect()->route('agent.quotes.payment-gateway', ['quote_id' => $quote_id]);
        }

    }

    public function changes()
    {

        $this->payment_amount = (float) $this->payment_amount;
        //  dd($this->payment_amount);
        session()->put('payment_amount', $this->payment_amount);
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.bookings.additional-payments-component');
    }
}
