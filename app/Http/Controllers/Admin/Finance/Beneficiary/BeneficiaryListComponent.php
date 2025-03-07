<?php

namespace App\Http\Controllers\Admin\Finance\Beneficiary;

use Livewire\Component;
use App\Models\BeneficiaryMaster;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class BeneficiaryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $beneficiaryId;
    public $is_edit, $beneficiary_name, $status, $search_beneficiary, $Id;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getBeneficiarys()
    {
        return BeneficiaryMaster::query()
            ->searchLike('beneficiary_name', $this->search_beneficiary)
            ->desc()->paginate($this->perPage);
    }

    public function filterBeneficiary()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['beneficiary_name', 'status']);
        $this->resetPage();
    }

    public function getModalContent(BeneficiaryMaster $beneficiaryMaster)
    {
        $this->modalData = $beneficiaryMaster;
    }

    public function save()
    {
        $validated = $this->validate([
			'beneficiary_name' => [
				'required',
				Rule::unique('aihut_beneficiary', 'beneficiary_name')
					->ignore($this->Id)
					->whereNull('deleted_at') // Exclude soft-deleted records
			],
		]);
        $validated['is_active'] = $this->status ?? 1;

        BeneficiaryMaster::create($validated);
        $this->alert('success', Lang::get('messages.beneficiary_save'));
        $this->dispatch('close-modal', modal: 'crudModal');
        return redirect()->route('admin.beneficiary.index');
    }

    public function edit(BeneficiaryMaster $beneficiaryMaster)
    {
        $this->resetValidation();
        $this->is_edit = true;
        $this->beneficiaryId = $beneficiaryMaster->id;
        $this->beneficiary_name = $beneficiaryMaster->beneficiary_name;
        $this->status = $beneficiaryMaster->is_active;
    }

    public function update()
    {

        $validated = $this->validate([
            'beneficiary_name' => 'required|unique:aihut_beneficiary,beneficiary_name,' . $this->beneficiaryId,
        ]);

        BeneficiaryMaster::whereId($this->beneficiaryId)->update($validated);
        $this->alert('success', Lang::get('messages.beneficiary_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        return redirect()->route('admin.beneficiary.index');
    }

    public function toggleStatus(BeneficiaryMaster $beneficiaryMaster)
    {
        // dd($beneficiaryMaster);
        $this->beneficiaryId = $beneficiaryMaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $beneficiaryData = BeneficiaryMaster::whereId($this->beneficiaryId);
        $beneficiaryData->update(['is_active' => !$beneficiaryData->first()->is_active]);
        $this->alert('success', Lang::get('messages.beneficiary_status_changed'));
        $this->filterBeneficiary();
    }

    public function isDelete(BeneficiaryMaster $beneficiaryMaster)
    {
        $this->beneficiaryId = $beneficiaryMaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $beneficiaryData = BeneficiaryMaster::whereId($this->beneficiaryId);
        $beneficiaryData->delete();
        $this->alert('success', Lang::get('messages.beneficiary_delete'));
    }

    public function render()
    {
        return view('admin.finance.beneficiary.beneficiary-list-component', [
            'beneficiarys' => $this->getBeneficiarys(),
        ]);
    }
}
