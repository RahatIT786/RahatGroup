<?php

namespace App\Http\Controllers\Admin\PackageManagement\PackageType;

use Livewire\Component;
use App\Models\PackageType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class PackageTypeListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $packageTypeId, $Id, $is_edit, $package_type, $status, $search_package;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getPackages()
    {
        return PackageType::query()
            ->searchLike('package_type', $this->search_package)
            ->desc()->paginate($this->perPage);
    }

    public function filterPackage()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['package_type', 'status']);
        $this->resetPage();
    }

    public function getModalContent(PackageType $packageType)
    {
        $this->modalData = $packageType;
    }

    public function save()
    {
        $validated = $this->validate([
            'package_type' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;

        PackageType::create($validated);
        $this->alert('success', Lang::get('messages.package_type_save'));
        return to_route('admin.packageType.index');
    }

    public function getEditData(PackageType $packageType)
    {
        $this->packageTypeId = $packageType->id;
        $this->package_type = $packageType->package_type;
        $this->status = $packageType->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'package_type' => 'required',
        ]);
        PackageType::whereId($this->packageTypeId)->update($validated);
        $this->alert('success', Lang::get('messages.package_type_update'));
        return redirect()->route('admin.packageType.index');
    }


    public function toggleStatus(PackageType $packageType)
    {
        // dd($packageType);
        $this->packageTypeId = $packageType->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $packagetypeData = PackageType::whereId($this->packageTypeId);
        $packagetypeData->update(['is_active' => !$packagetypeData->first()->is_active]);
        $this->alert('success', Lang::get('messages.package_type_status_changed'));
        $this->filterPackage();
    }

    public function isDelete(PackageType $packageType)
    {
        $this->packageTypeId = $packageType->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $packagetypeData = PackageType::whereId($this->packageTypeId);
        $packagetypeData->delete();
        $this->alert('success', Lang::get('messages.package_type_delete'));
    }

    public function isDupicate(PackageType $packagetype)
    {
        // dd($packagetype);
        $this->Id = $packagetype->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }
    public function confirmDuplicate()
    {
        $packageMasterData = PackageType::find($this->Id);
        $validated['package_type'] = $packageMasterData->package_type;
        $validated['is_active'] = $packageMasterData->status ?? 1;
        PackageType::create($validated);
        $this->alert('success', 'Package Type Inserted Successfully');
    }

    public function render()
    {
        return view('admin.package-management.package-type.package-type-list-component', [
            'packages' => $this->getPackages(),
        ]);
    }
}
