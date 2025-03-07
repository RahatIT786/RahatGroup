<?php

namespace App\Http\Controllers\Admin\Finance\Forex;

use App\Models\Beneficiary;
use App\Models\Company;
use App\Models\Forex;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ForexEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $beneficiary, $companyData;
    public $sar, $sar_rate, $amount, $total_amount;
    public $package_includes = [];
    public $gst, $id;
    public $handling_charges, $txn_date, $beneficiary_id, $company_id, $types, $bank_name, $particularts;

    public function mount(Forex $forex)
    {
        $this->beneficiary = Beneficiary::pluck('beneficiary_name', 'id');
        $this->companyData = Company::pluck('company_name', 'id');
        $this->txn_date = $forex->txn_date;
        $this->id = $forex->id;
        $this->beneficiary_id = $forex->beneficiary_id;
        $this->company_id = $forex->company_id;
        $this->sar = $forex->sar;
        $this->sar_rate = $forex->sar_rate;
        $this->gst = $forex->gst;
        $this->handling_charges = $forex->handling_charges;
        $this->types = $forex->types;
        $this->bank_name = $forex->bank_name;
        $this->particularts = $forex->particularts;
        $this->amount = $forex->amount;
        $this->total_amount = $forex->tot_amount;
    }
    public function update()
    {
        $validated = $this->validate([
            'txn_date' => 'required',
            'beneficiary_id' => 'required',
            'company_id' => 'required',
            'sar' => 'required',
            'sar_rate' => 'required',

        ], [], [
            'txn_date' => 'Date',
            'beneficiary_id' => 'Beneficiary Name',
            'company_id' => 'Company Name',
            'sar' => 'Company Name',
            'sar_rate' => 'Company Name',
        ]);

        $validated['amount'] = $this->amount;
        $validated['gst'] = $this->gst;
	    $validated['handling_charges'] = $this->handling_charges;
        $validated['tot_amount'] = $this->total_amount;
        $validated['bank_name'] = $this->bank_name;
        $validated['particularts'] = $this->particularts;
        $validated['types'] = $this->types;
        $forex = Forex::find($this->id);
        $forex->update($validated);
        $this->alert('success', Lang::get('messages.forex_update'));
        return redirect()->route('admin.forex.index');
    }

    public function calculateAmount()
    {
        if (!empty($this->sar) && !empty($this->sar_rate) && empty($this->gst)) {
            $this->amount =  $this->total_amount = $this->sar * $this->sar_rate;
        } else {
            $this->amount = '';
        }
    }

    public function calculateTotalAmount()
    {
        if (empty($this->gst) && empty($this->handling_charges)) {
            $this->total_amount = $this->amount;
        } else {
            $total = $this->amount;

            if (!empty($this->gst)) {
                $total += $this->gst;
            }
            if (!empty($this->handling_charges)) {
                $total += $this->handling_charges;
            }

            $this->total_amount = $total;
        }
    }
    public function render()
    {
        return view('admin.finance.forex.forex-edit-component');
    }
}
