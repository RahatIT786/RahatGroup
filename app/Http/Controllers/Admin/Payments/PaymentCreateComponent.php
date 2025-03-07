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

class PaymentCreateComponent extends Component
{
    use LivewireAlert;
    public $agencies, $agency_id, $bookings = [], $booking_id, $tot_cost, $tot_paid = 0, $balance, $companies;
    public $company_name, $banks = [], $bank_name, $acountDetails;
    public $deposite_type, $txn_id, $txn_date, $comment = '', $amount, $personName;

    public function mount()
    {
        $this->agencies = Agent::active()->OrderBy('agency_name', 'ASC')->get();
        // $this->bookings = Booking::active()->get();
        $this->companies = BankDetail::select('id', 'company_name')
            ->groupBy('id', 'company_name')
            ->orderBy('company_name', 'asc')
            ->get();

        // dd($this->companies);
    }

    public function getBookings()
    {
        $this->reset(['bookings', 'booking_id', 'balance', 'tot_paid']);
        if ($this->agency_id) {
            $this->bookings = Booking::where('agency_id', $this->agency_id)->active()->get();
        }
    }

    public function getBalance($booking_id)
    {
        $this->reset(['tot_paid', 'balance']);
        if ($booking_id) {
            $all_payments = Payment::where('booking_id', $booking_id)->where('payment_status', 1)->get();
            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('id', $booking_id)->value('tot_cost');
            $this->balance = $this->tot_cost - $this->tot_paid;
        }
    }

    public function getBank()
    {
        $this->reset(['banks', 'bank_name', 'acountDetails']);
        if ($this->company_name) {
            $this->banks = BankDetail::where('company_name', $this->company_name)->get();
        }
    }
    public function getBeneficiaryDetails()
    {


        $acount = BankDetail::select('bank_details')->where('company_name', $this->company_name)->where('bank_name', $this->bank_name)->first();

        $this->acountDetails = $acount->bank_details;

        //    dd($this->acountDetails);

    }

    public function save()
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

        ], [
            'agency_id.required' => 'Please select an agency',
            'booking_id.required' => 'Please Select a Booking Id',
            'deposite_type.required' => 'Please select deposite type',
            'amount.required' => 'Please select an amount',
            'company_name.required' => 'Please select a company',
            'bank_name.required' => 'Please select a Bank',
            'txn_id.required' => 'Please enter cheque number or transaction number',
            'txn_date.required' => 'Please select the transaction date',
            'acountDetails.required' => 'Please select the transaction date',
        ]);

        $last_record = Payment::withTrashed()->orderBy('receipt_id', 'desc')->first();

        $receipt_id = $last_record->receipt_id + 1;

        // dd($this->agency_id, $this->booking_id);

        Payment::create([
            'booking_id' => $this->booking_id,
            'receipt_id' => $receipt_id,
            'deposite_type' => $this->deposite_type,
            'amount' => $this->amount,
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

        $this->alert('success', 'Successfully Added');
        return redirect()->route('admin.payment.index');
    }


    public function render()
    {
        return view('admin.payments.payment-create-component');
    }
}
