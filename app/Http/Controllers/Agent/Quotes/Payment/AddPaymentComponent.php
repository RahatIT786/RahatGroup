<?php

namespace App\Http\Controllers\Agent\Quotes\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Agent;
use App\Models\Pnr;
use App\Models\BankDetail;
use App\Mail\PaymentOfflineConfirmationMail;
use Illuminate\Support\Facades\Mail;

class AddPaymentComponent extends Component
{
    use LivewireAlert;
    public $quote, $advance, $companies, $agencies, $payment_amount = '';
    public $company_name, $banks, $bank_name, $acountDetails, $txn_id, $balance, $deposite_type, $txn_date, $personName, $comment;

    public function mount($quote_id)
    {

        $this->payment_amount = session()->get('payment_amount');
        //dd($this->payment_amount);
        $this->quote = Booking::whereId($quote_id)->with('package','pnr.company')->first();
        // dd($this->quote->pnr->company->company_name);
        $this->agencies = Agent::active()->OrderBy('agency_name', 'ASC')->get();
        $this->companies = BankDetail::select('id', 'company_name')
            ->groupBy('id', 'company_name')
            ->orderBy('company_name', 'asc')
            ->get();
        // dd($this->companies);

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

        $payment = Payment::create([

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
        $thisBooking = $this->quote; // Assuming $this->quote is an instance of Booking model
        $thisBooking->update([
            'booking_id' => $this->quote->request_id,
        ]);

        // $count_payments = Payment::where('booking_id', $this->quote->id)->count();
        $count_payments = Payment::where('booking_id', $this->quote->id)->get();

        if (count($count_payments) == 1) {
            if ($this->payment_amount > 0.98 * $thisBooking->tot_cost) {
                if ((($this->quote->service_type == 2 && $this->quote->package->umrah_type == 1) || $this->quote->service_type == 20)) {
                    $seats = Pnr::whereId($this->quote->pnr_id)->first();
                    $avai_seats = $seats->avai_seats;
                    $tot_pax = $this->quote->adult + $this->quote->child_bed + $this->quote->child;
                    $updated_avai_seats = $avai_seats - $tot_pax;
                    $seats->update([
                        'avai_seats' => $updated_avai_seats
                    ]);
                }
                // $payment_difference = $thisBooking->tot_cost - $count_payments[0]->amount;
                // $thisBooking->update(['is_paid' => 1, 'release_tkt' => 1, 'release_visa' => 1, 'full_payment_discount' => $payment_difference]);
            }
        }
        if (count($count_payments) > 1) {
            $totalAmount = $count_payments->sum('amount');
            if($totalAmount >= $thisBooking->tot_cost){
                if ((($this->quote->service_type == 2 && $this->quote->package->umrah_type == 1) || $this->quote->service_type == 20)) {
                    $seats = Pnr::whereId($this->quote->pnr_id)->first();
                    $avai_seats = $seats->avai_seats;
                    $tot_pax = $this->quote->adult + $this->quote->child_bed + $this->quote->child;
                    $updated_avai_seats = $avai_seats - $tot_pax;
                    $seats->update([
                        'avai_seats' => $updated_avai_seats
                    ]);
                }
            }
        }
        // Send Payment Offline Confirmation Email
        // Mail::to($this->booking->email_id)->cc('joddhajitputel143@gmail.com')->send(new PaymentOfflineConfirmationMail($payment, $thisBooking));
        // Mail::to($this->quote->agency->email)->cc('joddhajitputel143@gmail.com')->send(new PaymentOfflineConfirmationMail($payment, $thisBooking));
        // $this->alert('success', 'Successfully Added');
        return redirect()->route('agent.bookings.index');
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.payment.add-payment-component');
    }
}
