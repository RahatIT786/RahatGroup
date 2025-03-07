<?php

namespace App\Http\Controllers\Admin\PackageManagement\LaundryType;

use Livewire\Component;
use App\Models\LaundryMaster;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class LaundryTypeListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $price, $lundray_type, $status, $laundryTypeId, $search_laundrytype;
    public $modalData, $is_edit, $Id;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getLaundryType()
    {

        return LaundryMaster::query()
            ->searchLike('lundray_type', $this->search_laundrytype)
            ->desc()->paginate($this->perPage);
        // $laundry =  LaundryMaster::query()
        //     ->searchLike('lundray_type', $this->search_laundrytype)
        //     ->desc()->get();
        // dd($laundry);

    }

    public function filterLaundryTypes()
    {
        $this->resetPage();
    }

    public function resetForm()
    {   
        $this->resetValidation();
        $this->reset(['lundray_type', 'price', 'status']);
        // $this->resetPage();
    }

    public function getModalContent(LaundryMaster $laundrymaster)
    {
        $this->modalData = $laundrymaster;
    }

    public function save()
    {
        $validated = $this->validate([
            'lundray_type' => 'required',
            'price' => 'required',
        ]);
        $validated['lundray_type'] = $this->lundray_type;
        $validated['price'] = $this->price;
        $validated['is_active'] = $this->status ?? 1;

        LaundryMaster::create($validated);
        $this->alert('success', Lang::get('messages.laundrytype_save'));
        $this->dispatch('close-modal', modal: 'crudModal');
        // $this->resetPage();
        return redirect()->route('admin.laundryType.index');
    }

    public function edit(LaundryMaster $laundrymaster)
    {   
        $this->resetValidation();
        $this->is_edit = true;
        // dd( $this->is_edit );
        $this->laundryTypeId = $laundrymaster->id;
        $this->lundray_type = $laundrymaster->lundray_type;
        $this->price = $laundrymaster->price;
        $this->status = $laundrymaster->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'lundray_type' => 'required',
            'price' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;

        LaundryMaster::whereId($this->laundryTypeId)->update($validated);
        $this->alert('success', Lang::get('messages.laundrytype_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        // $this->resetPage();
        return redirect()->route('admin.laundryType.index');
    }
    
    public function toggleStatus(LaundryMaster $laundrymaster)
    {
        // dd($laundrymaster);
        $this->laundryTypeId = $laundrymaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $laundryData = LaundryMaster::whereId($this->laundryTypeId);
        $laundryData->update(['is_active' => !$laundryData->first()->is_active]);
        $this->alert('success', Lang::get('messages.laundrytype_status_changed'));
        $this->filterLaundryTypes();
    }

    public function isDelete(LaundryMaster $laundrymaster)
    {
        $this->laundryTypeId = $laundrymaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $laundryData = LaundryMaster::whereId($this->laundryTypeId);
        $laundryData->delete();
        $this->alert('success', Lang::get('messages.laundrytype_delete'));
    }



    public function isDupicate(LaundryMaster $laundrymaster)
    {
        // dd($packagemaster);
        $this->Id = $laundrymaster->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
        // $packageMasterData->delete();
    }

    public function confirmDuplicate()
    {
        try {
            $loundryMasterData = LaundryMaster::find($this->Id);
            $copyloundryMasterData = [
                'lundray_type' => $loundryMasterData->lundray_type,
                'price' => $loundryMasterData->price,
            ];
            LaundryMaster::create($copyloundryMasterData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new package master: ' . $e->getMessage());
        }
        $this->alert('success', 'Laundry Type Inserted Successfully');
    }

    public function render()
    {
        return view('admin.package-management.laundry-type.laundry-type-list-component',[
            'laundrytypes' => $this->getLaundryType(),
        ]);
    }
}
