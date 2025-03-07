<?php

namespace App\Http\Controllers\Admin\Finance\SiteBankInfo;

use Livewire\Component;
use App\Models\SiteBankInfo;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class SiteBankInfoCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $bank_name, $account_number, $bank_address, $ifsc_code;

    public function save()
    {
        $validated = $this->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'bank_address' => 'required',
            'ifsc_code' => 'required',

        ], [], [
            'bank_name' => 'bank name',
            'account_number' => 'account number',
            'bank_address' => 'bank address',
            'ifsc_code' => 'ifsc code',
        ]);
        SiteBankInfo::create($validated);
        $this->alert('success', Lang::get('messages.site_bank_info_save'));
        return redirect()->route('admin.siteBankInfo.index');
    }

    public function render()
    {
        return view('admin.finance.site-bank-info.site-bank-info-create-component');
    }
}
