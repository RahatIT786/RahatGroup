<?php

namespace App\Http\Controllers\Admin\Sector;

use App\Models\SectorMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SectorListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $sector_name, $id, $is_edit, $search_sector, $sectormasterId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getSector()
    {
        return SectorMaster::query()
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
        SectorMaster::create($validated);
        $this->alert('success', Lang::get('messages.sector_save'));
        return redirect()->route('admin.addSector.index');
    }
    public function edit(SectorMaster $sectormaster)
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
        SectorMaster::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.sector_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        return redirect()->route('admin.addSector.index');
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

    public function toggleStatus(SectorMaster $sectormaster)
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
        $sectorMasterData = SectorMaster::whereId($this->sectormasterId);
        $sectorMasterData->update(['is_active' => !$sectorMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.sector_status_changed'));
        
    }

    public function isDelete(SectorMaster $sectormaster)
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
        $sectorData = SectorMaster::whereId($this->sectormasterId);
        $sectorData->delete();
        $this->alert('success', Lang::get('messages.sector_delete'));
    }
    
    public function render()
    {
        return view('admin.sector.sector-list-component', [
            'sectors' => $this->getSector(),
        ]);
    }
}
