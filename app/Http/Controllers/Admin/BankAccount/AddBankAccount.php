<?php

namespace App\Http\Controllers\Admin\BankAccount;

use App\Models\BankAccount;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\MainCompany;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class AddBankAccount extends Component
{
    use WithFileUploads, LivewireAlert;

    public $company_name, $account_name, $account_no, $ifsc_swift, $bank_name;
    public $branch_name, $iban_no, $gst, $pan_card;

    protected $rules = [
        'company_name' => 'required|string|max:150',
        'account_name' => 'required|string|max:150',
        'account_no' => 'required|string|max:20',
        'ifsc_swift' => 'required|string|max:20',
        'bank_name' => 'required|string|max:50',
        'branch_name' => 'nullable|string|max:50',
        'iban_no' => 'nullable|string|max:20',
        'gst' => 'nullable|string|max:45',
        'pan_card' => 'required|string|max:10',
    ];

    public function save()
    {
        $this->validate();

        BankAccount::create([
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

        session()->flash('message', 'Bank Account saved successfully!');
        $this->reset();
    }


    public function render()
    {
        return view('admin.bank-account.add-bankaccount');
    }
}
