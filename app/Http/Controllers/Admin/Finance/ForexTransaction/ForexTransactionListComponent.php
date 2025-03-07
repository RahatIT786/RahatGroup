<?php

namespace App\Http\Controllers\Admin\Finance\ForexTransaction;

use App\Models\Beneficiary;
use App\Models\Forex;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class ForexTransactionListComponent extends Component
{
    public $benificiary, $Beneficiary, $benificiaryId, $forexData,$credit;
    public function getForexTransaction()
    {
        return Forex::where('is_active', 1)->get();
    }
    public function mount()
    {
        $this->benificiary = Beneficiary::pluck('beneficiary_name', 'id');
    }
    public function benificiarySearch()
    {
        $this->forexData = Forex::where('beneficiary_id', $this->benificiaryId)->get();
    }
    
    public function downloadInvoice($benificiaryId)
    {
        // Retrieve data
        $forexData = Forex::where('beneficiary_id', $benificiaryId)->get();
        $companyNameData = Forex::with('company')->where('beneficiary_id', $benificiaryId)->first();
        $companyName = $companyNameData->company->company_name;
        if (!$forexData) {
            return response()->json(['error' => 'not found'], 404);
        }
        $data = [
            'forexData' => $forexData,
            'companyNameData' => $companyName,
        ];
        $pdf = Pdf::loadView('admin.finance.forex-transaction.forextransaction_pdf', $data);
        $docName = "Forex-transaction" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function render()
    {
        return view('admin.finance.forex-transaction.forex-transaction-list-component', [
            'ForexTransaction' => $this->getForexTransaction()
        ]);
    }
}
