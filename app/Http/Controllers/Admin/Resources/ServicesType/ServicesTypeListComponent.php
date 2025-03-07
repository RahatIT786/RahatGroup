<?php

namespace App\Http\Controllers\Admin\Resources\ServicesType;

use Illuminate\Support\Facades\Lang;
use App\Models\ServiceType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ServicesTypeListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $id, $is_edit, $name, $status, $typesId, $search_name, $Id;
    protected $listeners = ['confirmed'];
    public function getServiceType()
    {
        return ServiceType::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function getEditData(ServiceType $serviceType)
    {
        $this->resetValidation();
        $this->Id = $serviceType->id;
        $this->name = $serviceType->name;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|unique:aihut_service_type,name,' . $this->Id,
        ], [], [
            'name' => 'Service Name',
        ]);
        ServiceType::whereId($this->Id)->update($validated);
        $this->alert('success', Lang::get('messages.service_type_update'));
        return redirect()->route('admin.manageServices.index');
    }

    public function toggleStatus(ServiceType $type)
    {

        $this->typesId = $type->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $typess = ServiceType::whereId($this->typesId);
        $typess->update(['is_active' => !$typess->first()->is_active]);
        $this->alert('success', Lang::get('messages.service_status_changed'));
    }

    public function filterSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['name', 'status']);
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.resources.services-type.services-type-list-component', [
            'ServiceTypes' => $this->getServiceType()
        ]);
    }
}
