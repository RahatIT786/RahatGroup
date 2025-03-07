<?php

namespace App\Http\Controllers\Admin\Finance\BankDetails;

use App\Models\BankDetail;
use App\Models\City;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class BankDetailsCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $cityData, $company_name, $bank_name, $account_holder, $city, $address, $bank_details;

    public function mount()
    {
        $this->cityData = City::pluck('city_name', 'id');
    }

    public function save()
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
        BankDetail::create($validated);
        $this->alert('success', Lang::get('messages.bank_details_save'));
        return redirect()->route('admin.bankDetails.index');
    }

    public function render()
    {
        return view('admin.finance.bank-details.bank-details-create-component');
    }
}
