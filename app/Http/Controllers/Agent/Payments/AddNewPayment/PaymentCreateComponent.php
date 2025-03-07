<?php
namespace App\Http\Controllers\Agent\Payments\AddNewPayment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Agent;
use App\Models\BankDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Helpers\Helper;

class PaymentCreateComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $agencies, $bookings, $booking_id, $tot_cost, $tot_paid = 0, $balance,$companies;
    public $company_name,$banks,$bank_name,$acountDetails;
    public $deposite_type, $txn_id, $txn_date, $comment = '', $amount, $personName,$agent_id;

    public function mount(){

        $this->agent_id = auth()->user('agent')->id;
        // dd($this->agent_id);
        $this->bookings = Booking::where('agency_id', $this->agent_id)->get();
        // dd($this->bookings);
        $this->agencies = Agent::active()->OrderBy('agency_name','ASC')->get();
        $this->companies = BankDetail::select('id', 'company_name')
        ->groupBy('id', 'company_name')
        ->orderBy('company_name', 'asc')
        ->get();
    }

    public function getBalance($booking_id)
    {
        // dd($booking_id);
        $this->reset(['tot_paid', 'balance']);
        
        if ($booking_id) {
            $all_payments = Payment::where('booking_id', $booking_id)->where('payment_status',1)->get();
            $this->tot_paid = $all_payments->sum('amount');
            $this->tot_cost = Booking::where('booking_id', $booking_id)->value('tot_cost');
            $this->balance = $this->tot_cost - $this->tot_paid;
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
        $acount = BankDetail::select('bank_details')->where('company_name',$this->company_name)->where('bank_name',$this->bank_name)->first();
        $this->acountDetails = $acount->bank_details;

    //    dd($this->acountDetails);
    }

    public function save()
    {   
        // dd($this->txn_id);
        $validated = $this->validate([

            'booking_id' => 'required',     
            'deposite_type' => 'required',  
            'amount' => 'required',
            'company_name' => 'required',
            'bank_name' => 'required',
            'txn_id' => 'required',
            'txn_date' => 'required',
            'acountDetails' => 'required',
            
        ], [

            'booking_id.required' => 'Please Select a Booking Id',
            'deposite_type.required' => 'Please select deposite type',
            'amount.required' => 'Please select an amount',
            'company_name.required' => 'Please select a company',
            'bank_name.required' => 'Please select a Bank',
            'txn_id.required' => 'Please enter cheque number or transaction number',
            'txn_date.required' => 'Please select the transaction date',     
            'acountDetails.required' => 'Please select the transaction date',                   
        ]);

        $last_record = Payment::withTrashed()->orderBy('id','desc')->first();

        $receipt_id = $last_record->receipt_id + 1 ;
        
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
        return redirect()->route('agent.payment.index');

    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.payments.add-new-payment.payment-create-component');     
    }
}
