<?php

namespace App\Http\Controllers\Agent\Payment;
use Livewire\Attributes\Layout;

use Livewire\Component;

class PaymentListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payment.payment-list-component');
    }
}
