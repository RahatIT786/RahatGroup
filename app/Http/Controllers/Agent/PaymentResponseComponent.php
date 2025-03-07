<?php

namespace App\Http\Controllers\Agent;

use App\Helpers\Helper;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use App\Mail\NegotiationSubmittedMail;


class PaymentResponseComponent extends Component
{   

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payment-response-component');
    }
}
