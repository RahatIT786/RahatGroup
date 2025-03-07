<?php

namespace App\Http\Controllers\Agent\Components;

use App\Models\Booking;
use App\Models\Bookingenquiry;
use App\Models\Payment;
use Livewire\Component;

class StatusBoxComponent extends Component
{
    public $quotes, $confirmedBookings, $pendingBookings, $cancelledBookings, $totalPayments, $pendingPayments, $pendingApprovals, $agentWallet;

    public function mount()
    {
        $this->quotes = Booking::agentFilter()->whereNull('booking_id')->count() ?? 0;
        $this->confirmedBookings = Booking::agentFilter()->where('booking_status', 1)->count() ?? 0;
        $this->pendingBookings = Booking::agentFilter()->where('booking_status', 0)->count() ?? 0;
        $this->cancelledBookings = Booking::agentFilter()->cancelled()->count() ?? 0;
        $this->totalPayments = Payment::agentFilter()->sum('amount');
        $this->pendingPayments = Booking::agentFilter()->paid()->sum('tot_cost') - Payment::agentFilter()->where(['payment_status' => 1, 'is_paid' => 1])->sum('amount');
        $this->pendingApprovals = Payment::agentFilter()->where(['payment_status' => 0, 'is_paid' => 0])->sum('amount') ?? 0;
        $this->agentWallet = 0;
    }
    public function render()
    {
        return view('agent.components.status-box-component');
    }
}
