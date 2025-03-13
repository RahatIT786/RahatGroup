<?php

namespace App\Http\Controllers\Admin\BankAccount;

use App\Helpers\Helper;
use App\Models\Booking;
use App\Models\Payment;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Illuminate\Support\Collection;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;
use App\Mail\NegotiationAdminApproveMail;
use App\Mail\NegotiationAdminRejectMail;
use App\Mail\NegotiationAdminRenegotiateMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Agent;
use App\Models\AdminSetting;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Lang;

class BankAccountList extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $delId;
    public $allAccounts;
    public $bankAccount;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmApprove', 'confirmReject'];
    public $currentSegment, $search_booking_id, $search_mehram_name, $search_name, $perPage = 10;
    public $allBookings, $booking_id, $booking_modal_data = null, $payments_modal_data = null, $search_start_date, $search_end_date, $total_amount, $payment_amount, $payments_modal_status = [], $total_amount_int, $negotiated_request, $negotiated_amount;
    public $showConfirmation = false;
    public $changeNegotiateAmount = false, $re_negotiate_amount;

    public function getQuotes()
    {
        $query = Booking::query()->with('agency', 'servicetype', 'payment')
            ->where('booking_id', '=', null)
            ->where('negotiated_cost', '!=', null)
            ->desc();

        $this->allBookings = $query->get();

        return $query->paginate($this->perPage);
    }

    public function filterBookings()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }


    public function isApprove(Booking $booking)
    {
        $this->negotiated_request = $booking;
        $this->negotiated_amount = $booking->negotiated_cost;
        $this->confirm('Are you sure to approve this negotiation ?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmApprove',
        ]);
    }

    public function confirmApprove()
    {
        // dd($this->negotiated_request);
        $approved = $this->negotiated_request->update([
            'tot_cost' => $this->negotiated_amount,
            'negotiation_status' => 1
        ]);
        $agency_email = Agent::where('id', $this->negotiated_request->agency_id)->active()->value('email');
        if ($approved) {

            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($agency_email)->cc('biswajitadas15@gmail.com')->send(new NegotiationAdminApproveMail($this->negotiated_request,  $adminSetting, $adminwhatsapp,'approved'));
            $this->alert('success', 'Negotiation amount approved successfully');
            // $this->render();
        } else {
            $this->alert('error', 'Something went wrong !');
            // $this->render();
        }
    }
    public function isReject(Booking $booking)
    {
        $this->negotiated_request = $booking;
        $this->negotiated_amount = $booking->negotiated_cost;
        $this->confirm('Are you sure to reject this negotiation ?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmReject',
        ]);
    }
    public function confirmReject()
    {
        $rejected = $this->negotiated_request->update([
            'negotiation_status' => 2
        ]);
        $agency_email = Agent::where('id', $this->negotiated_request->agency_id)->active()->value('email');
        if ($rejected) {
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($agency_email)->cc('biswajitadas15@gmail.com')->send(new NegotiationAdminRejectMail($this->negotiated_request,  $adminSetting, $adminwhatsapp, 'Reject'));
            $this->alert('success', 'Negotiation Amount Rejected Successfully');
        } else {
            $this->alert('error', 'Something went wrong !');
        }
    }
    public function reNegotiate(Booking $booking)
    {

        $this->negotiated_request = $booking;
        $this->negotiated_amount = $booking->negotiated_cost;
        $this->changeNegotiateAmount = true;
        // dd( $this->negotiated_amount);
    }
    public function updateNegotiate()
    {
        // dd($this->negotiated_amount,$this->re_negotiate_amount);
        $changed = $this->negotiated_request->update([
            'negotiated_cost' => $this->re_negotiate_amount,
            'tot_cost' => $this->re_negotiate_amount,
            'negotiation_status' => 1
        ]);
        $agency_email = Agent::where('id', $this->negotiated_request->agency_id)->active()->value('email');
        if ($changed) {
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            Mail::to($agency_email)->cc('biswajitadas15@gmail.com')->send(new NegotiationAdminRenegotiateMail($this->negotiated_request,  $adminSetting, $adminwhatsapp, 'Reject'));

            $this->alert('success', 'Negotiation Amount Changed Successfully');
            return redirect()->route('admin.quotes.negotiated');
        } else {
            $this->alert('error', 'Something went wrong !');
        }
    }

    //------------------------------------------

    public function getAccounts()
    {
        $query = BankAccount::with('company')
            ->where('delete_status', 1)
            ->orderByDesc('created_at');

        $this->allAccounts = $query->get();
        return $query->paginate($this->perPage);
    }

    public function getAgentContent(BankAccount $bankAccount)
    {
        $bankAccount->load('state');
        $this->bankAccount = $bankAccount;
    }

    public function isDelete(BankAccount $bankAccount)
    {
        // dd($enquirie);
        $this->delId = $bankAccount->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);

    }
    public function confirmDelete()
    {
        $backAccountData = BankAccount::whereId($this->delId);
        $backAccountData->delete();
        $this->alert('success', Lang::get('messages.user_delete'));
    }

    public function render()
    {
        return view('admin.bank-account.bankaccount-list', [

            'accounts' => $this->getAccounts(),
        ]);
    }
}
