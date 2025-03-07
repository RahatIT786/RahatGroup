<?php

namespace App\Http\Controllers\Admin\Finance\Forex;

use App\Helpers\Helper;
use App\Models\Beneficiary;
use App\Models\Company;
use App\Models\Forex;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ForexCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $beneficiary, $companyData;
    public $sar, $sar_rate, $amount, $total_amount;
    public $package_includes = [];
    public $gst;
    public $handling_charges, $txn_date, $beneficiary_id, $company_id, $types, $bank_name, $particularts;

    public function mount()
    {
        $this->beneficiary = Beneficiary::pluck('beneficiary_name', 'id');
        $this->companyData = Company::pluck('company_name', 'id');
        $this->types = "CREDIT";

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

    public function save()
    {
        // 'reference_no' => $reference_no,
        $validated = $this->validate([
            'txn_date' => 'required',
            'beneficiary_id' => 'required',
            'company_id' => 'required',
            'sar' => 'required',
            'sar_rate' => 'required',
           	// 'gst' => 'required',
            // 'handling_charges' => 'required',
            // 'types' => 'required',
            // 'bank_name' => 'required',
            // 'particularts' => 'required',
        ], [], [
            'txn_date' => 'Date',
            'beneficiary_id' => 'Beneficiary Name',
            'company_id' => 'Company Name',
            'sar' => 'Company Name',
            'sar_rate' => 'Company Name',
            // 'gst' => 'Gst',
            // 'handling_charges' => 'Handling Charges',
            // 'types' => 'type',
            // 'bank_name' => 'Bank Name',
            // 'particularts' => 'Particularts Name',
        ]);

        $validated['reference_no'] =  rand(1000000, 9999999);
        $validated['is_active'] = $this->status ?? 1;
        $validated['amount'] = $this->amount;
    	$validated['gst'] = $this->gst;
    	$validated['handling_charges'] = $this->handling_charges;
        $validated['tot_amount'] = $this->total_amount;
        $validated['types'] = $this->types;
        $validated['bank_name'] = $this->bank_name;
        $validated['particularts'] = $this->particularts;
        // dd($validated);
        Forex::create($validated);
        $this->alert('success', Lang::get('messages.forex_save'));
        return redirect()->route('admin.forex.index');
    }

    public function render()
    {
        return view('admin.finance.forex.forex-create-component');
    }
}
