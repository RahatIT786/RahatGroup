<?php

namespace App\Http\Controllers\Admin\Resources\Flier;

use App\Models\Flier;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ManageFlierListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_name, $search_code, $FlierId, $flierId;

    public function getFlier()
    {
        return Flier::query()
            ->searchLike('service_name', $this->search_name)
            ->searchLike('flier_code', $this->search_code)
            ->desc()
            ->paginate($this->perPage);
    }
    public function isDelete(Flier $flier)
    {
        $this->FlierId = $flier->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $flierData = Flier::whereId($this->FlierId);
        $flierData->delete();
        $this->alert('success', Lang::get('messages.flier_delete'));
    }
    public function toggleStatus(Flier $flier)
    {
        // dd($user);
        $this->flierId = $flier->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $adminData = Flier::whereId($this->flierId);
        $adminData->update(['is_active' => !$adminData->first()->is_active]);
        $this->alert('success', Lang::get('messages.flier_status_changed'));
    }
    public function filterFlier()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function render()
    {
        return view('admin.resources.flier.manage-flier-list-component', [
            'Fliers' => $this->getFlier()
        ]);
    }
}
