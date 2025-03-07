<?php

namespace App\Http\Controllers\Admin\Finance\BankDetails;

use App\Models\BankDetail;
use App\Models\City;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class BankDetailsListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $perPage = 10, $bankdetailsId, $city, $search_company, $search_bank, $content_modal_data, $BankDetailsId, $bankStsId, $Id;
    public function getBankDetails()
    {
        return BankDetail::query()
            ->with('getcity') // Load the agent relationship
            ->searchLike('company_name', $this->search_company)
            ->searchLike('bank_name', $this->search_bank)
            ->desc()
            ->paginate($this->perPage);
    }

    public function isDelete(BankDetail $bankDetails)
    {
        $this->BankDetailsId = $bankDetails->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bankData = BankDetail::whereId($this->BankDetailsId);
        $bankData->delete();
        $this->alert('success', Lang::get('messages.bank_details_delete'));
    }
    public function toggleStatus(BankDetail $notificationSts)
    {
        // dd($user);
        $this->bankStsId = $notificationSts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $notificationStsData = BankDetail::whereId($this->bankStsId);
        $notificationStsData->update(['is_active' => !$notificationStsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.bank_status_changed'));
    }
    public function isDupicate(BankDetail $bankDetail)
    {
        // dd($bankDetail);
        $this->bankdetailsId = $bankDetail->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }

    public function confirmDuplicate()
    {
        try {
            $BankdetailsData = BankDetail::find($this->bankdetailsId);
            $copybankdetailsData = [
                'company_name' => $BankdetailsData->company_name,
                'bank_name' => $BankdetailsData->bank_name,
                'account_holder' => $BankdetailsData->account_holder,
                'city' => $BankdetailsData->city,
                'address' => $BankdetailsData->address,
                'bank_details' => $BankdetailsData->bank_details,
                'is_active' => $BankdetailsData->is_active,
            ];
            BankDetail::create($copybankdetailsData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new BankDetail : ' . $e->getMessage());
        }
        $this->alert('success', 'Record has been Duplicated successfully');
    }

    public function getContent(BankDetail $bankdetails)
    {
        $this->content_modal_data = $bankdetails;
    }

    public function filterBank()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function render()
    {
        // dd($this->getBankDetails());
        return view('admin.finance.bank-details.bank-details-list-component', [
            'bankDetails' => $this->getBankDetails()
        ]);
    }
    
}
