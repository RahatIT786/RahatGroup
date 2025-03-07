<?php

namespace App\Http\Controllers\Admin\PackageManagement\TransportType;

use Livewire\Component;
use App\Models\TransportMaster;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class TransportTypeListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $price, $transport_type, $status, $transportTypeId, $search_transport_type;
    public $modalData, $is_edit, $Id;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getTransportTypes()
    {
        return TransportMaster::query()
            ->searchLike('transport_type', $this->search_transport_type)
            ->desc()->paginate($this->perPage);
    }

    public function filterTransportType()
    {
        $this->resetPage();
    }

    public function resetForm()
    { 
        $this->resetValidation();
        $this->reset(['transport_type', 'price', 'status']);
        $this->resetPage();
    }

    public function getModalContent(TransportMaster $transportMaster)
    {
        $this->modalData = $transportMaster;
    }

    public function save()
    {
        $validated = $this->validate([
            'transport_type' => 'required',
            'price' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;

        TransportMaster::create($validated);
        $this->alert('success', Lang::get('messages.transport_type_save'));
        $this->dispatch('close-modal', modal: 'crudModal');
        return redirect()->route('admin.transportType.index');
        // $this->resetPage();
    }

    public function edit(TransportMaster $transportMaster)
    {   
        $this->resetValidation();
        $this->is_edit = true;
        // dd( $this->is_edit );
        $this->transportTypeId = $transportMaster->id;
        $this->transport_type = $transportMaster->transport_type;
        $this->price = $transportMaster->price;
        $this->status = $transportMaster->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'transport_type' => 'required',
            'price' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;

        TransportMaster::whereId($this->transportTypeId)->update($validated);
        $this->alert('success', Lang::get('messages.transport_type_update'));
        $this->dispatch('close-modal', modal: 'crudModal');
        $this->is_edit = false;
        // $this->resetPage();
        return redirect()->route('admin.transportType.index');
    }
    
    public function toggleStatus(TransportMaster $transportMaster)
    {
        // dd($transportMaster);
        $this->transportTypeId = $transportMaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $transportData = TransportMaster::whereId($this->transportTypeId);
        $transportData->update(['is_active' => !$transportData->first()->is_active]);
        $this->alert('success', Lang::get('messages.transport_type_status_changed'));
        $this->filterTransportType();
    }

    public function isDelete(TransportMaster $transportMaster)
    {
        $this->transportTypeId = $transportMaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $transportData = TransportMaster::whereId($this->transportTypeId);
        $transportData->delete();
        $this->alert('success', Lang::get('messages.transport_type_delete'));
    }

    public function isDupicate(TransportMaster $transportmaster)
    {
        // dd($transportmaster);
        $this->Id = $transportmaster->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }

    public function confirmDuplicate()
    {
        try {
            $transMasterData = TransportMaster::find($this->Id);
            $copyloundryMasterData = [
                'transport_type' => $transMasterData->transport_type,
                'price' => $transMasterData->price,
            ];
            TransportMaster::create($copyloundryMasterData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new package master: ' . $e->getMessage());
        }
        $this->alert('success', 'Transport Type Inserted Successfully');
    }

    public function render()
    {
        return view('admin.package-management.transport-type.transport-type-list-component',[
            'transportTypes' => $this->getTransportTypes(),
        ]);
    }
}
