<?php

namespace App\Http\Controllers\Admin\Resources\Miscellaneous;

use App\Models\Miscellaneous;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class MiscellaneousItemsListComponent extends Component
{
    protected $listeners = ['toggleStatus', 'statusConfirm', 'confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_items, $status, $Id, $item, $item_value, $miscellaneousId;

    public function getMiscellaneousItem()
    {
        return Miscellaneous::query()
            ->searchLike('item', $this->search_items)
            ->desc()
            ->paginate($this->perPage);
    }
    public function save()
    {
        $validated = $this->validate([
            'item' => 'required',
            'item_value' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        Miscellaneous::create($validated);
        $this->alert('success', Lang::get('messages.admin_save'));
        return to_route('admin.miscellaneousItems.index');
    }
    public function getEditData(Miscellaneous $Miscellaneous)
    {
        $this->resetValidation();
        $this->Id = $Miscellaneous->id;
        $this->item = $Miscellaneous->item;
        $this->item_value = $Miscellaneous->item_value;
    }

    public function update()
    {
        $this->validate([
            'item' => 'required',
            'item_value' => 'required',
        ]);

        $Miscellaneous = Miscellaneous::findOrFail($this->Id); // Find the company by ID

        $Miscellaneous->update([
            'item' => $this->item,
            'item_value' => $this->item_value,
        ]);
        $this->alert('success', Lang::get('messages.miscellaneous_update'));
        return redirect()->route('admin.miscellaneousItems.index');
    }
    public function statusConfirm(Miscellaneous $Miscellaneous)
    {
        // dd($company);

        $this->Id = $Miscellaneous->id;
        if ($Miscellaneous->is_active == 1) {
            $this->confirm('Are you sure to Inactivate  this ?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
            ]);
        } else {
            $this->confirm('Are you sure to Activate this ?', [
                'icon' => 'question',
                'confirmButtonText' => 'Yes',
                'onConfirmed' => 'confirmed',
            ]);
        }
    }
    public function confirmed()
    {
        $Miscellaneous = Miscellaneous::whereId($this->Id);
        $Miscellaneous->update(['is_active' => !$Miscellaneous->first()->is_active]);
        $this->alert('success', Lang::get('messages.miscellaneous_status_changed'));
    }

    public function isDelete(Miscellaneous $Miscellaneous)
    {
        $this->miscellaneousId = $Miscellaneous->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $MiscellaneousData = Miscellaneous::whereId($this->miscellaneousId);
        $MiscellaneousData->delete();
        $this->alert('success', Lang::get('messages.miscellaneous_delete'));
    }

    public function filterMiscellaneous()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['item', 'status']);
        $this->reset(['item_value', 'status']);
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.resources.miscellaneous.miscellaneous-items-list-component', [
            'Miscellaneous' => $this->getMiscellaneousItem()
        ]);
    }
}
