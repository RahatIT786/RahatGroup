<?php

namespace App\Http\Controllers\Admin\BankAccount;

use App\Models\BankAccount;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\MainCompany;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class EditBankAccount extends Component
{
    use WithFileUploads, LivewireAlert;

    public $bankAccount;
    public $company_name, $account_name, $account_no, $ifsc_swift, $bank_name, $branch_name, $iban_no, $gst, $pan_card;

    public function mount($id)
    {
        $this->bankAccount = BankAccount::findOrFail($id); // Find the bank account by ID
        $this->company_name = $this->bankAccount->company_name;
        $this->account_name = $this->bankAccount->account_name;
        $this->account_no = $this->bankAccount->account_no;
        $this->ifsc_swift = $this->bankAccount->ifsc_swift;
        $this->bank_name = $this->bankAccount->bank_name;
        $this->branch_name = $this->bankAccount->branch_name;
        $this->iban_no = $this->bankAccount->iban_no;
        $this->gst = $this->bankAccount->gst;
        $this->pan_card = $this->bankAccount->pan_card;
    }

    public function save()
    {
        $this->validate([
            'company_name' => 'required|max:150',
            'account_name' => 'required|max:150',
            'account_no' => 'required|max:20',
            'ifsc_swift' => 'required|max:20',
            'bank_name' => 'required|max:150',
            'branch_name' => 'required|max:150',
            'iban_no' => 'required|max:50',
            'pan_card' => 'required|max:10',
        ]);

        $this->bankAccount->update([
            'company_name' => $this->company_name,
            'account_name' => $this->account_name,
            'account_no' => $this->account_no,
            'ifsc_swift' => $this->ifsc_swift,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'iban_no' => $this->iban_no,
            'gst' => $this->gst,
            'pan_card' => $this->pan_card,
        ]);

        session()->flash('message', 'Bank account updated successfully!');
    }

    public function render()
    {
        return view('admin.bank-account.edit-bankaccount');
    }
}
