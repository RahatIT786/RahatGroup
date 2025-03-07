<?php

namespace App\Http\Controllers\Agent\Payments\ApprovedPaymentList;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ApprovedPaymentListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $company, $payments_modal_data;
    
    
    public function getApprovedPayment()
    {
        return Payment::query()
                    ->with('booking')
                    ->searchLike('booking_id', $this->booking_id)
                    ->searchLike('company', $this->company)
                    ->desc()
                    ->paginate($this->perPage);
    }
    
    public function filterPayments()
    {
        $this->resetPage(); 
    }

    public function getPaymentContent(Payment $payment)
    {
        $this->payments_modal_data = $payment;

        // $booking = Booking::where('booking_id', $payment->booking_id)->first();

        // $this->tot_cost = $booking->tot_cost;
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payments.approved-payment-list.approved-payment-list-component', [
            'ApprovedPayments' => $this->getApprovedPayment()
        ]);
    }
}
