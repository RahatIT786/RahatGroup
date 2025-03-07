<?php

namespace App\Http\Controllers\Admin\Finance\Forex;

use App\Helpers\Helper;
use App\Models\Forex;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ForexListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $currentSegment, $search_booking_id, $search_name, $perPage = 10;
    public $booking_id, $booking_modal_data = null, $payments_modal_data = null, $search_reference_no, $search_beneficiary;
    public $showConfirmation = false;
    public $package_name, $package_type;
    public $modalData, $Id;

    public function getForex()
    {
        return Forex::desc()
            ->with('beneficiary', 'company')
            ->searchLike('reference_no', $this->search_reference_no)
            ->searchBeneficiaryName($this->search_beneficiary)
            ->paginate($this->perPage);
    }

    public function filterForex()
    {
        $this->resetPage();
    }

    public function getModalContent(Forex $forex)
    {
        $this->modalData = $forex;
    }

    public function isDelete(Forex $forex)
    {
        $this->Id = $forex->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $forexData = Forex::whereId($this->Id);
        $forexData->delete();
        $this->alert('success', Lang::get('messages.forex_delete'));
    }

    public function toggleStatus(Forex $forex)
    {
        $this->Id = $forex->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $forexData = Forex::whereId($this->Id);
        $forexData->update(['is_active' => !$forexData->first()->is_active]);
        $this->alert('success', Lang::get('messages.forex_status_changed'));
    }

    public function exportToExcel()
    {
        $forexData = $this->getForex();

        $resultArray = $forexData->map(function ($all_bookings) {
            return [
                'Serial No.' => $all_bookings->id,
                'Forex_Date' => $all_bookings->txn_date,
                'Reference_No'       => $all_bookings->reference_no,
                'Beneficiary_Name'   => $all_bookings->beneficiary->beneficiary_name,
                'Company_Name'       => $all_bookings->company->company_name ?? '-',
                'Amount'       => $all_bookings->amount,
                'Type'       => $all_bookings->types,
                'Bank_Name'       => $all_bookings->bank_name,
                'Particularts'       => $all_bookings->particularts,
            ];
        })->toArray();

        return Helper::exportToExcel($resultArray, 'Agents-Accounts-Detail.xlsx');
    }

    public function downloadInvoice()
    {
        $forexData = Forex::get();
        if (!$forexData) {
            return response()->json(['error' => 'not found'], 404);
        }
        // Prepare data for the PDF view
        $data = [
            'forexData' => $forexData,
        ];
        // Load the view and generate the PDF
        $pdf = Pdf::loadView('admin.finance.forex.forex-pdf-generator-component', $data);

        // Stream the PDF for download
        // $docName = $forexData->booking_id . "_" . time() . ".pdf";
        $docName = "Forex_List_" . time() . ".pdf";
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $docName);
    }

    public function render()
    {
        // dd($this->getForex());
        return view('admin.finance.forex.forex-list-component', [
            'forexData' => $this->getForex()
        ]);
    }
}
