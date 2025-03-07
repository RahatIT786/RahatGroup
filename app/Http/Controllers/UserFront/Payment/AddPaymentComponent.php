<?php

namespace App\Http\Controllers\UserFront\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Agent;
use App\Models\Pnr;
use App\Models\BankDetail;

class AddPaymentComponent extends Component
{
    use LivewireAlert;
    public $quote, $advance, $companies, $agencies, $payment_amount = '';
    public $company_name, $banks, $bank_name, $acountDetails, $txn_id, $balance, $deposite_type, $txn_date, $personName, $comment;
    public function mount($quote_id)
    {

        $this->payment_amount = session()->get('payment_amount');
        // dd($this->payment_amount);
        $this->quote = Booking::whereId($quote_id)->first();
        // dd($this->quote->booking_id);
        $this->agencies = Agent::active()->OrderBy('agency_name', 'ASC')->get();
        $this->companies = BankDetail::select('id', 'company_name')
            ->groupBy('id', 'company_name')
            ->orderBy('company_name', 'asc')
            ->get();
        //   dd($this->companies);

        if ($this->quote->booking_id) {
            $all_payments = Payment::where('booking_id', $this->quote->booking_id)->where('payment_status', 1)->get();
            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('booking_id', $this->quote->booking_id)->value('tot_cost');


            $this->balance = $this->tot_cost - $this->tot_paid;
        } else {
            $this->balance = $this->quote->tot_cost;
        }
    }
    public function getBank()
    {
        $this->reset(['banks', 'bank_name', 'acountDetails']);
        if ($this->company_name) {
            $this->banks = BankDetail::where('company_name', $this->company_name)->get();
        }
        //    dd($this->banks);
    }
    public function getBeneficiaryDetails()
    {
        // dd($this->bank_name);
        $acount = BankDetail::select('bank_details')->where('company_name', $this->company_name)->where('bank_name', $this->bank_name)->first();
        $this->acountDetails = $acount->bank_details;

        //    dd($this->acountDetails);
    }

    public function save()
    {
        // dd(
        //     $this->deposite_type,
        //     $this->payment_amount,
        //     $this->company_name,
        //     $this->bank_name,
        //     $this->txn_id,
        //     $this->txn_date,
        //     $this->acountDetails
        // );
        $validated = $this->validate([

            'deposite_type' => 'required',
            // 'payment_amount' => 'required',
            'company_name' => 'required',
            'bank_name' => 'required',
            'txn_id' => 'required',
            'txn_date' => 'required',
            'acountDetails' => 'required',

        ], [

            'deposite_type.required' => 'Please select deposite type',
            // 'payment_amount.required' => 'Please select an amount',
            'company_name.required' => 'Please select a company',
            'bank_name.required' => 'Please select a Bank',
            'txn_id.required' => 'Please enter cheque number or transaction number',
            'txn_date.required' => 'Please select the transaction date',
            'acountDetails.required' => 'Please select the transaction date',
        ]);

        $last_record = Payment::withTrashed()->orderBy('receipt_id', 'desc')->first();

        if ($last_record) {
            $receipt_id = $last_record->receipt_id + 1;
        } else {
            $receipt_id = 30000;
        }

        // dd($validated,$booking_id,$receipt_id);

        Payment::create([

            'booking_id' => $this->quote->id,
            'receipt_id' => $receipt_id,
            'deposite_type' => $this->deposite_type,
            'amount' => $this->payment_amount,
            'company' => $this->company_name,
            'bank_name' => $this->bank_name,
            'txn_id' => $this->txn_id,
            'txn_date' => $this->txn_date,
            'bank_account_no' => $this->acountDetails,
            'personal_name' => $this->personName,
            'comment' => $this->comment,
            'payment_status' => 0,
            'is_paid' => 0,
        ]);
        session()->forget('payment_amount');

        $booking = Booking::whereNotNull('booking_id')->orderBy('id', 'desc')->first();
        $booking_id = (int) $booking->booking_id;
        $thisBooking = $this->quote; // Assuming $this->quote is an instance of Booking model
        $thisBooking->update([
            'booking_id' => $booking_id + 1,
        ]);

        $count_payments = Payment::where('booking_id', $this->quote->id)->count();

        if ($count_payments == 1 && $this->quote->service_type == 2) {
            $seats = Pnr::whereId($this->quote->pnr_id)->first();
            $avai_seats = $seats->avai_seats;
            $tot_pax = $this->quote->adult + $this->quote->child_bed + $this->quote->child;

            $updated_avai_seats = $avai_seats - $tot_pax;
            $seats->update([
                'avai_seats' => $updated_avai_seats
            ]);
        }

        $this->alert('success', 'Successfully Added');
        return redirect()->route('customer.quotes.index');
    }
    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.payment.add-payment-component');
    }
}
