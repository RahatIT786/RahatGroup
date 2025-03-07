<?php

namespace App\Http\Controllers\Admin\Payments;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Agent;
use App\Models\BankDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;


class PaymentEditComponent extends Component
{
    use LivewireAlert;
    public $agencies, $agency_id, $bookings = [], $booking_id, $tot_cost, $tot_paid = 0, $balance,$companies;
    public $company_name,$banks = [],$bank_name,$acountDetails, $payment_id;
    public $deposite_type, $txn_id, $txn_date, $comment = '', $amount, $personal_name, $paidStatus, $paymentStatus;

    public function mount(Payment $payment)
    {

        // dd($payment);
        $this->payment_id = $payment->id;
        // Fetch the booking associated with the payment
        $booking = Booking::where('id', $payment->booking_id)->first();

        // Set the agency_id and company_name from the fetched booking and payment
        $this->agency_id = $booking->agency_id;
        $this->company_name = $payment->company;

        // Fetch and set the list of agencies
        $this->agencies = Agent::active()->orderBy('agency_name', 'ASC')->get();

        // Fetch and set the list of bookings for the selected agency
        $this->bookings = Booking::where('agency_id', $this->agency_id)->active()->get();

        $this->booking_id = $payment->booking_id;
        // dd($this->booking_id);
        // Fetch and set the list of companies
        $this->companies = BankDetail::select('id', 'company_name')
            ->groupBy('id', 'company_name')
            ->orderBy('company_name', 'asc')
            ->get();

        $this->banks = BankDetail::where('company_name',$this->company_name)->get();

        $this->deposite_type = $payment->deposite_type;

        $this->amount = $payment->amount;

        $this->bank_name = $payment->bank_name;

        $this->acountDetails = $payment->bank_account_no;

        $this->txn_id = $payment->txn_id;

        $this->comment = $payment->comment;
        // dd($this->comment);

        $this->txn_date = Carbon::parse($payment->txn_date)->toDateString();

        $this->personal_name = $payment->personal_name ;
        // dd($this->personal_name);

        $this->paidStatus = $payment->is_paid;

        $this->paymentStatus = $payment->payment_status;


        $all_payments = Payment::where('id',$this->booking_id)->where('payment_status',1)->get();
        // dd($all_payments);
        foreach ($all_payments as $eachPayment) {
            $this->tot_paid += $eachPayment->amount;
        }

        // Fetch the total cost for the booking
        $booking_tot_cost = Booking::select('tot_cost')->where('id', $this->booking_id)->first();

        if ($booking_tot_cost) {
            $this->tot_cost = $booking_tot_cost->tot_cost;
            $this->balance = $this->tot_cost - $this->tot_paid;
        }

        //  dd($this->balance); // Uncomment this line to debug the fetched bookings
    }
    public function getBookings()
    {
        // dd($this->agency_id);
        $this->bookings = Booking::where('agency_id',$this->agency_id)->active()->get();

        // dd($this->bookings);
        $this->booking_id = '';
        // $this->balance = 0;


    }
    // public function getBalance()
    // {
    //     if($this->booking_id){
    //         $all_payments = Payment::where('booking_id',$this->booking_id)->get();
    //         $this->tot_paid = 0;
    //         foreach ($all_payments as $eachPayment) {
    //             $this->tot_paid += $eachPayment->amount;
    //         }

    //         $this->tot_cost = Booking::select('tot_cost')->where('booking_id',$this->booking_id)->first();
    //         $this->balance = $this->tot_cost->tot_cost - $this->tot_paid;
    //     }
    // }
    public function getBalance($booking_id)
    {
        $this->balance = 0;
        if($booking_id){
            $all_payments = Payment::where('booking_id',$booking_id)->get();

            // dd($all_payments);
            $this->tot_paid = 0;
            foreach ($all_payments as $eachPayment) {
                $this->tot_paid += $eachPayment->amount;
            }

            $this->tot_cost = Booking::select('tot_cost')->where('booking_id',$booking_id)->first();

            $this->balance = $this->tot_cost->tot_cost - $this->tot_paid;

        }
    }

    public function getBank()
    {
        // dd('hi');
        $this->banks = BankDetail::where('company_name',$this->company_name)->get();
        $this->bank_name = '';
        $this->acountDetails = '';
    }
    public function getBeneficiaryDetails()
    {
        $acount = BankDetail::select('bank_details')->where('company_name',$this->company_name)->where('bank_name',$this->bank_name)->first();
        // dd($acount);
        $this->acountDetails = $acount != null ? $acount->bank_details : "";
    }

    public function update()
    {
        $validated = $this->validate([
            'agency_id' => 'required',
            'booking_id' => 'required',
            'deposite_type' => 'required',
            'amount' => 'required',
            'company_name' => 'required',
            'bank_name' => 'required',
            'txn_id' => 'required',
            'txn_date' => 'required',
            'acountDetails' => 'required',
            // 'personal_name' => 'required',
        ]);

        $paymentData = Payment::find($this->payment_id);

        if (!$paymentData) {
            $this->alert('error', 'Payment record not found.');
            return;
        }

        $bookingData = Booking::find($paymentData->booking_id);

        if (!$bookingData) {
            $this->alert('error', 'Booking record not found.');
            return;
        }

        Payment::where('id', $this->payment_id)->update([
            'booking_id' => $this->booking_id,
            'deposite_type' => $this->deposite_type,
            'amount' => $this->amount,
            'company' => $this->company_name,
            'bank_name' => $this->bank_name,
            'txn_id' => $this->txn_id,
            'txn_date' => $this->txn_date,
            'bank_account_no' => $this->acountDetails,
            'personal_name' => $this->personal_name,
            'comment' => $this->comment,
            'payment_status' => $this->paymentStatus,
            'is_paid' => $this->paidStatus,
        ]);

        $paid_amount = Payment::where('booking_id', $bookingData->booking_id)
            ->where('is_paid', '1')
            ->where('payment_status', '1')
            ->sum('amount');

        if ($bookingData->tot_cost == $paid_amount) {
            $bookingData->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1]);
        }

        $this->alert('success', 'Successfully Updated');
        return redirect()->route('admin.payment.index');
    }

    public function render()
    {
        return view('admin.payments.payment-edit-component');
    }
}
