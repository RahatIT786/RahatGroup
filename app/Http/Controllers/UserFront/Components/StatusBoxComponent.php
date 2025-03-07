<?php

namespace App\Http\Controllers\UserFront\Components;

use App\Models\Booking;
use App\Models\Bookingenquiry;
use App\Models\Payment;
use Livewire\Component;

class StatusBoxComponent extends Component
{
    public $quotes, $confirmedBookings, $pendingBookings, $cancelledBookings, $totalPayments, $pendingPayments, $pendingApprovals, $agentWallet;

    public function mount()
    {
        $this->quotes = Booking::UserFilter()->whereNull('booking_id')->count() ?? 0;
        $this->confirmedBookings = Booking::UserFilter()->where('booking_status', 1)->count() ?? 0;
        $this->pendingBookings = Booking::UserFilter()->where('booking_status', 0)->count() ?? 0;
        $this->cancelledBookings = Booking::UserFilter()->cancelled()->count() ?? 0;
        // $this->totalPayments = Payment::UserFilter()->sum('amount');
        // $this->pendingPayments = Booking::UserFilter()->paid()->sum('tot_cost') - Payment::agentFilter()->where(['payment_status' => 1, 'is_paid' => 1])->sum('amount');
        // $this->pendingApprovals = Payment::UserFilter()->where(['payment_status' => 0, 'is_paid' => 0])->sum('amount') ?? 0;
        // $this->agentWallet = 0;
    }
    public function render()
    {
        return view('user-front.components.status-box-component');
    }
}
