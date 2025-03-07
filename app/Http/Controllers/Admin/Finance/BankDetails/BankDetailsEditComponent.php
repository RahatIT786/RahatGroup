<?php

namespace App\Http\Controllers\Admin\Finance\BankDetails;

use App\Models\BankDetail;
use App\Models\City;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankDetailsEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $citydata, $id, $company_name, $bank_name, $account_holder, $city, $address, $bank_details;

    public function mount(BankDetail $bankDetail)
    {
        // dd($bankDetail);
        $this->id = $bankDetail->id;
        $this->company_name = $bankDetail->company_name;
        $this->bank_name = $bankDetail->bank_name;
        $this->account_holder = $bankDetail->account_holder;
        $this->city = $bankDetail->city;
        $this->address = $bankDetail->address;
        $this->bank_details = $bankDetail->bank_details;
        $this->citydata = City::pluck('city_name', 'id');
    }

    public function update()
    {
        $validated = $this->validate([
            'company_name' => 'required',
            'bank_name' => 'required',
            'account_holder' => 'required',
            'city' => 'required',
            'address' => 'required',
            'bank_details' => 'required',

        ], [], [
            'company_name' => 'company name',
            'bank_name' => 'bank name',
            'account_holder' => 'account holder',
            'city' => 'city',
            'address' => 'address',
            'bank_details' => 'bank details',
        ]);
        $bank = BankDetail::find($this->id);
        $bank->update($validated);
        $this->alert('success', Lang::get('messages.bank_details_update'));
        return to_route('admin.bankDetails.index');
    }

    public function render()
    {
        return view('admin.finance.bank-details.bank-details-edit-component');
    }
}
