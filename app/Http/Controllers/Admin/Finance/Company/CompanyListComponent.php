<?php

namespace App\Http\Controllers\Admin\Finance\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CompanyListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['toggleStatus', 'statusConfirm', 'confirmed', 'confirmDelete'];
    public $Id, $search_company, $company_name, $perPage = 10, $status;
    public function getCompany()
    {

        return Company::searchLike('company_name', $this->search_company)
            ->orderByDesc('id') // Assuming you want to order by the creation date
            ->paginate($this->perPage);
    }

    public function save()
    {
        $this->validate([
            'company_name' => 'required|unique:aihut_company,company_name,' . $this->Id,
        ]);

        Company::create([
            'company_name' => $this->company_name,
        ]);

        $this->alert('success', Lang::get('messages.company_save'));
        return redirect()->route('admin.company.index');
    }

    public function getEditData(Company $company)
    {
        $this->resetValidation();
        $this->Id = $company->id;
        $this->company_name = $company->company_name;
    }

    public function update()
    {
        $this->validate([
            'company_name' => 'required|unique:aihut_company,company_name,' . $this->Id,
        ]);

        $company = Company::findOrFail($this->Id);

        $company->update([
            'company_name' => $this->company_name,
        ]);
        $this->alert('success', Lang::get('messages.company_update'));
        return redirect()->route('admin.company.index');
    }

    public function filterCompany()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['company_name', 'status']);
        $this->resetPage();
    }

    public function statusConfirm(Company $company)
    {
        $this->Id = $company->id;
        if ($company->is_active == 1) {
            $this->confirm('Are you sure to Inactivate  this ?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
            ]);
        } else {
            $this->confirm('Are you sure to Activate this ?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
            ]);
        }
    }
    public function confirmed()
    {
        $Company = Company::whereId($this->Id);
        $Company->update(['is_active' => !$Company->first()->is_active]);
        $this->alert('success', Lang::get('messages.company_status_changed'));
    }

    public function isDelete(Company $company)
    {
        $this->Id = $company->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $companyData = Company::whereId($this->Id);
        $companyData->delete();
        $this->alert('success', Lang::get('messages.company_delete'));
    }
    public function render()
    {
        return view('admin.finance.company.company-list-component', [
            'companies' => $this->getCompany()
        ]);
    }
}
