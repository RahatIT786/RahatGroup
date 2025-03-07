<?php

namespace App\Http\Controllers\UserFront\Quotes;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Booking;
use App\Models\Agency;
use App\Models\Payment;
use Livewire\Attributes\Layout;

class PaymentConfirmComponent extends Component
{
    use LivewireAlert;
    public $quote, $advance, $payment_amount = '', $full_payment_amount = '', $confirmationChecked = false;
    public $data, $atomTokenId, $agent, $payments, $balance;

    private $paymentService;

    public function mount($quote_id)
    {

        $this->quote = Booking::whereId($quote_id)->first();
        // dd($this->quote);
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
        // dd($this->quote);

        //Payment Gateway

    }
    public function checked() {}
    public function proceed($paymentType, $quote_id)
    {
        //  dd($paymentType,$quote_id);

        $validated = $this->validate([
            'payment_amount' => 'required',
        ], [
            'payment_amount.required' => 'Please select an amount',

        ]);

        if ($paymentType == 'Offline') {
            return redirect()->route('customer.quotes.offline-payment', ['quote_id' => $quote_id]);
        } else if ($paymentType == 'paymentGateway') {
            return redirect()->route('customer.quotes.payment-gateway', ['quote_id' => $quote_id]);
        }
    }

    public function changes()
    {
        $this->payment_amount = (float) $this->payment_amount;
        if ($this->quote->tot_cost == $this->payment_amount) {

            $this->full_payment_amount = $this->quote->tot_cost;
            $onePercentValue = ($this->quote->tot_cost * 1) / 100;

            $this->full_payment_amount = $this->payment_amount - $onePercentValue;
            // $this->reset(['payment_amount']);
            session()->put('payment_amount', $this->full_payment_amount);
        } else {
            // $this->reset(['full_payment_amount']);
            session()->put('payment_amount', $this->payment_amount);
        }
        // dd($this->payment_amount,$this->full_payment_amount);
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.quotes.payment-confirm-component');
    }
}
