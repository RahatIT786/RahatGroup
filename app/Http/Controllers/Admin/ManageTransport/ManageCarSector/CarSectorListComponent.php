<?php

namespace App\Http\Controllers\Admin\ManageTransport\ManageCarSector;

use Livewire\Component;
use App\Models\CarSectorMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class CarSectorListComponent extends Component
{

    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $sector_name, $id, $is_edit, $search_sector, $sectormasterId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getSector()
    {
        return CarSectorMaster::query()
            ->searchLike('sector_name', $this->search_sector)
            ->desc()
            ->paginate($this->perPage);
    }

    public function save()
    {
        $validated = $this->validate([
            'sector_name' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        CarSectorMaster::create($validated);
        $this->alert('success', Lang::get('messages.carsector_save'));
        return redirect()->route('admin.manageCarSector.index');
    }
    public function edit(CarSectorMaster $sectormaster)
    {
        // dd($city);
        $this->is_edit = true;
        $this->id = $sectormaster->id;
        $this->sector_name = $sectormaster->sector_name;
    }
    public function update()
    {
        $this->resetValidation();

        $validated = $this->validate([
            'sector_name' => 'required',
        ]);
        CarSectorMaster::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.carsector_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        return redirect()->route('admin.manageCarSector.index');
    }
    public function filterSector()
    {
        $this->resetPage();
    }
    public function resetForm()
    {
        $this->is_edit = false;
        $this->reset(['sector_name',]);
    }

    public function toggleStatus(CarSectorMaster $sectormaster)
    {
        $this->sectormasterId = $sectormaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $sectorMasterData = CarSectorMaster::whereId($this->sectormasterId);
        $sectorMasterData->update(['is_active' => !$sectorMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.carsector_status_changed'));
    }

    public function isDelete(CarSectorMaster $sectormaster)
    {
        $this->sectormasterId = $sectormaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $sectorData = CarSectorMaster::whereId($this->sectormasterId);
        $sectorData->delete();
        $this->alert('success', Lang::get('messages.carsector_delete'));
    }

    public function render()
    {
        return view('admin.manage-transport.manage-car-sector.car-sector-list-component', [
            'sectors' => $this->getSector(),
        ]);
    }
}
