<?php

namespace App\Http\Controllers\Admin\Components;

use App\Models\Booking;
use App\Models\Bookingenquiry;
use App\Models\Payment;
use Livewire\Component;

class StatusBoxComponent extends Component
{
    public $quotes, $confirmedBookings, $pendingBookings, $bookingEnquiries, $totalPayments, $pendingPayments, $pendingApprovals, $agentWallet, $totalPaymentsdone, $totalPaymentsbalance;

    public function mount()
    {
        $this->quotes = Booking::whereNull('booking_id')->count() ?? 0;
        $this->confirmedBookings = Booking::where('booking_status', 1)->count() ?? 0;
        $this->pendingBookings = Booking::where('booking_status', 0)->count() ?? 0;
        $this->bookingEnquiries = Bookingenquiry::where('status', 1)->count() ?? 0;
        // Total payments sum
        $this->totalPayments = Payment::sum('amount');

        // Total payments done
        $this->totalPaymentsdone = Payment::where(['payment_status' => 1, 'is_paid' => 1])->sum('amount');

        // Total payments balance
        $this->totalPaymentsbalance = $this->totalPayments - $this->totalPaymentsdone;

        $this->pendingPayments = Booking::paid()->sum('tot_cost') - Payment::where(['payment_status' => 1, 'is_paid' => 1])->sum('amount');
        $this->pendingApprovals = Payment::where(['payment_status' => 0, 'is_paid' => 0])->sum('amount') ?? 0;
        $this->agentWallet = 0;
    }


    public function render()
    {
        return view('admin.components.status-box-component');
    }
}
