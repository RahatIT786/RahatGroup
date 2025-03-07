<?php

namespace App\Http\Controllers\Admin\Resources\PnrServices;

use App\Models\PnrService;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;


class PnrServicesListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $id, $is_edit, $name, $status, $typesId, $search_name, $Id;
    protected $listeners = ['confirmed'];
    public function getPnrServices()
    {
        return PnrService::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    // public function edit(PnrService $type)
    // {

    //     $this->is_edit = true;
    //     $this->id = $type->id;
    //     $this->name = $type->name;
    // }
    public function getEditData(PnrService $pnr)
    {
        $this->resetValidation();
        $this->Id = $pnr->id;
        $this->name = $pnr->name;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required|unique:aihut_pnr_service,name,' . $this->Id,
        ], [], [
            'name' => 'pnr name',
        ]);
        PnrService::whereId($this->Id)->update($validated);
        $this->alert('success', Lang::get('messages.pnrservice_type_update'));
        return redirect()->route('admin.pnrServices.index');
    }

    public function toggleStatus(PnrService $type)
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
        $typess = PnrService::whereId($this->typesId);
        $typess->update(['is_active' => !$typess->first()->is_active]);
        $this->alert('success', Lang::get('messages.pnr_status_changed'));
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
        return view('admin.resources.pnr-services.pnr-services-list-component', [
            'PnrService' => $this->getPnrServices()
        ]);
    }
}
