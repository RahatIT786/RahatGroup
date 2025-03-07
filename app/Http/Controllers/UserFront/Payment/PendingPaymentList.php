<?php

namespace App\Http\Controllers\UserFront\Payment;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PendingPaymentList extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $booking_id, $company, $payments_modal_data, $booking_ids = [];
    public $tot_paid, $tot_cost, $balance, $search_start_date, $search_end_date;

    public function getPendingPayment()
    {
        $customerId =  auth()->user()->id;
        $all_bookings = Booking::where('user_type', $customerId)->get();

        foreach ($all_bookings as $booking) {
            array_push($this->booking_ids, $booking->id);
        }

        $query = Payment::whereIn('booking_id', $this->booking_ids)
            ->pending()
            // ->where('deposite_type', 'Online')
            // ->where('deposite_type', 'Cash')
            // ->where('deposite_type', 'Cheque')
            ->SearchBookinId($this->booking_id)
            ->searchLike('booking_id', $this->booking_id)
            ->searchTransactionDate($this->search_start_date, $this->search_end_date);
        $this->payment = $query->get();
        // $this->bookingcount =  $query->count();
        return $query->paginate($this->perPage);
    }

    // public function getPendingPayment()
    // {
    //     $customerId = auth()->user()->id;

    //     // Assuming 'user_type' is not the correct field for user ID, let's correct it
    //     // Use 'user_id' or the relevant column that stores customer ID in Booking
    //     $this->booking_ids = Booking::where('user_type', $customerId)->pluck('id')->toArray();

    //     // Query for payments that are pending and associated with the user's bookings
    //     $query = Payment::with('booking')
    //         ->whereIn('booking_id', $this->booking_ids) // Filter by user's booking IDs
    //         ->pending()  // Assuming 'pending' is a query scope
    //         ->orderByDesc('id');  // Sort by latest payment

    //     // Paginate results, using $this->perPage or default to 10
    //     $results = $query->paginate($this->perPage ?? 10);

    //     return $results;
    // }

    public function filterPayments()
    {
        $this->resetPage();
    }

    // public function getPaymentContent(Payment $payment)
    // {
    //      $this->payments_modal_data = $payment;
    //      $booking = Booking::where('booking_id',$payment->booking_id)->first();
    //      $this->tot_cost = $booking->tot_cost;

    //      if ($booking->id) {
    //         $all_payments = Payment::where('booking_id', $booking->booking_id)->where('payment_status',1)->get();
    //         $this->tot_paid = $all_payments->sum('amount');
    //         $this->tot_cost = Booking::where('booking_id', $booking->booking_id)->value('tot_cost');
    //         $this->balance = $this->tot_cost - $this->tot_paid;
    //     }
    // }
    public function getPaymentContent(Payment $payment)
    {
        // dd('hi');
        $this->payments_modal_data = $payment;

        $booking_id = Booking::where('id', $payment->booking_id)->first();

        $this->reset(['tot_paid', 'balance']);
        if ($booking_id) {
            $all_payments = Payment::where('booking_id', $booking_id->booking_id)->where('is_paid', 1)->where('payment_status', 1)->get();

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

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.payment.pending-payment-list', [
            'PendingPayments' => $this->getPendingPayment()
        ]);
    }
}
