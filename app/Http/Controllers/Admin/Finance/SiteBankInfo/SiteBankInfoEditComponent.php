<?php

namespace App\Http\Controllers\Admin\Finance\SiteBankInfo;

use Livewire\Component;
use App\Models\SiteBankInfo;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class SiteBankInfoEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public  $id, $bank_name, $account_number, $bank_address, $ifsc_code;

    public function mount(SiteBankInfo $siteBankInfo)
    {
        // dd($siteBankInfo);
        $this->id = $siteBankInfo->id;
        $this->bank_name = $siteBankInfo->bank_name;
        $this->account_number = $siteBankInfo->account_number;
        $this->bank_address = $siteBankInfo->bank_address;
        $this->ifsc_code = $siteBankInfo->ifsc_code;
    }

    public function update()
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
        $bank = SiteBankInfo::find($this->id);
        $bank->update($validated);
        $this->alert('success', Lang::get('messages.site_bank_info_update'));
        return to_route('admin.siteBankInfo.index');
    }

    public function render()
    {
        return view('admin.finance.site-bank-info.site-bank-info-edit-component');
    }
}
