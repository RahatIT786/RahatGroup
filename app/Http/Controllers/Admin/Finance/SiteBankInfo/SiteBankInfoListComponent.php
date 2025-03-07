<?php

namespace App\Http\Controllers\Admin\Finance\SiteBankInfo;

use Livewire\Component;
use App\Models\SiteBankInfo;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SiteBankInfoListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_bank_name, $status, $id, $is_edit, $bank_name,$bankStsId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getSiteBankInfo()
    {
        return SiteBankInfo::query()
            ->searchLike('bank_name', $this->search_bank_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(SiteBankInfo $notificationSts)
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
        $notificationStsData = SiteBankInfo::whereId($this->bankStsId);
        $notificationStsData->update(['is_active' => !$notificationStsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.site_bank_info_changed'));
    }

    public function isDelete(SiteBankInfo $notificationSts)
    {
        $this->bankStsId = $notificationSts->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bankData = SiteBankInfo::whereId($this->bankStsId);
        $bankData->delete();
        $this->alert('success', Lang::get('messages.site_bank_info_delete'));
    }

    public function filterSiteBankInfo()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.finance.site-bank-info.site-bank-info-list-component', [
            'bankDetails' => $this->getSiteBankInfo()
        ]);
    }
}
