<?php

namespace App\Http\Controllers\Admin\ManageTransport\ManageCarType;

use Livewire\Component;
use App\Models\CarTypeMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CarTypeListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $car_type, $id, $is_edit, $search_cartype, $cartypeId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getCarType()
    {
        return CarTypeMaster::query()
            ->searchLike('car_type', $this->search_cartype)
            ->desc()
            ->paginate($this->perPage);
    }

    public function save()
    {
        $validated = $this->validate([
            'car_type' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        CarTypeMaster::create($validated);
        $this->alert('success', Lang::get('messages.cartype_save'));
        return redirect()->route('admin.manageCarType.index');
    }
    public function edit(CarTypeMaster $cartypeMaster)
    {
        $this->is_edit = true;
        $this->id = $cartypeMaster->id;
        $this->car_type = $cartypeMaster->car_type;
    }
    public function update()
    {
        $this->resetValidation();

        $validated = $this->validate([
            'car_type' => 'required',
        ]);
        CarTypeMaster::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.cartype_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        return redirect()->route('admin.manageCarType.index');
    }
    public function filterCarType()
    {
        $this->resetPage();
    }
    public function resetForm()
    {
        $this->is_edit = false;
        $this->reset(['car_type',]);
    }

    public function toggleStatus(CarTypeMaster $cartypeMaster)
    {
        $this->cartypeId = $cartypeMaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $cartypeData = CarTypeMaster::whereId($this->cartypeId);
        $cartypeData->update(['is_active' => !$cartypeData->first()->is_active]);
        $this->alert('success', Lang::get('messages.cartype_status_changed'));
    }

    public function isDelete(CarTypeMaster $cartypeMaster)
    {
        $this->cartypeId = $cartypeMaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $sectorData = CarTypeMaster::whereId($this->cartypeId);
        $sectorData->delete();
        $this->alert('success', Lang::get('messages.cartype_delete'));
    }


    public function render()
    {
        return view('admin.manage-transport.manage-car-type.car-type-list-component', [
            'CarType' => $this->getCarType(),
        ]);
    }
}
