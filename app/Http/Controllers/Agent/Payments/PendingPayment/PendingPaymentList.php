<?php

namespace App\Http\Controllers\Agent\Payments\PendingPayment;

use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Barryvdh\DomPDF\Facade\Pdf;

class PendingPaymentList extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $company, $payments_modal_data,$booking_ids=[];
    public $tot_paid, $tot_cost, $balance,$search_start_date, $search_end_date;
    public function getPendingPayment()
    {
        // $agentId =  auth()->user()->id;
        // $all_bookings = Booking::where('agency_id',$agentId)->get();

        // foreach($all_bookings as $booking){
        //     array_push($this->booking_ids,$booking->booking_id);
        // }

        // $query = Payment::whereIn('booking_id', $this->booking_ids)
        // ->pending()
        // ->where('deposite_type', 'cash')
        // ->searchLike('booking_id', $this->booking_id)
        // ->searchTransactionDate($this->search_start_date, $this->search_end_date);
        // $this->payment = $query->get();
        // dd($this->payment);
        // return $query->paginate($this->perPage);


         $query = Payment::with('booking')
        ->pending()
        ->SearchBookinId($this->booking_id)
        ->orderByDesc('id');

        $results = $query->paginate($this->perPage);
        // dd($results); // Dump the result to check if it's not null

       return $results;
    }

    public function filterPayments()
    {
        $this->resetPage();
    }

    public function getPaymentContent(Payment $payment)
    {
        // dd('hi');
        $this->payments_modal_data = $payment;

        $booking_id = Booking::where('id', $payment->booking_id)->first();

        $this->reset(['tot_paid', 'balance']);
        if ($booking_id) {
            $all_payments = Payment::where('id', $booking_id->booking_id)->where('is_paid', 1)->where('payment_status', 1)->get();

            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('id', $booking_id->id)->value('tot_cost');
            $this->balance = $this->tot_cost - $this->tot_paid;
        }
    }

    public function getBookingContent($booking_id)
    {

        // $booking = Booking::where('booking_id', $booking_id)->first();
        $booking = Booking::whereId($booking_id)->first();



        $booking->load('agency', 'servicetype', 'city', 'pnr', 'package');
        $this->booking_modal_data = $booking;

        //  dd($this->booking_modal_data);
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payments.pending-payment.pending-payment-list', [
            'PendingPayments' => $this->getPendingPayment()
        ]);
    }
}
