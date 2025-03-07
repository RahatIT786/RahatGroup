<?php

namespace App\Http\Controllers\Admin\Resources\SharingType;

use App\Models\SharingType;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SharingTypeListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $status, $id, $is_edit, $name, $search_name, $typesId, $Id;
    protected $listeners = ['confirmed'];
    public function getSharingType()
    {
        return SharingType::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function getEditData(SharingType $sharingType)
    {
        $this->resetValidation();
        $this->Id = $sharingType->id;
        $this->name = $sharingType->name;
    }
    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|unique:aihut_sharing_type,name,' . $this->Id,
        ], [], [
            'name' => 'sharing name',
        ]);
        SharingType::whereId($this->Id)->update($validated);
        $this->alert('success', Lang::get('messages.sharing_type_update'));
        return redirect()->route('admin.sharingType.index');
    }

    public function toggleStatus(SharingType $type)
    {
        // dd($vehicleType);
        $this->typesId = $type->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $typess = SharingType::whereId($this->typesId);
        $typess->update(['is_active' => !$typess->first()->is_active]);
        $this->alert('success', Lang::get('messages.sharing_type_status_changed'));
        // $this->filterStaff();
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
        return view('admin.resources.sharing-type.sharing-type-list-component', [
            'SharingTypes' => $this->getSharingType()
        ]);
    }
}
