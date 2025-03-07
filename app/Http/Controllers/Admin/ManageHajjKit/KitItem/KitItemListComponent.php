<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\KitItem;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\KitItem;
use Illuminate\Support\Facades\Log;

class KitItemListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $kit = null, $kitId, $modalData = null, $kit_name, $Id;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getKitItem()
    {

        return KitItem::query()
            ->searchLike('kit_name', $this->kit_name)
            ->desc()->paginate($this->perPage);
    }
    public function isDelete(KitItem $Kittitems)
    {

        $this->kitId = $Kittitems->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',

        ]);

    }

    public function confirmDelete()
    {
        $carData = KitItem::whereId($this->kitId);
        //   dd($categoryData);
        $carData->delete();
        $this->alert('success', Lang::get('messages.kitt_item_delete'));

    }

    public function toggleStatus(KitItem $Kittitems)
    {

        $this->kitId = $Kittitems->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $kitData = KitItem::whereId($this->kitId);
        $kitData->update(['is_active' => !$kitData->first()->is_active]);
        $this->alert('success', Lang::get('messages.kitt_item_status_changed'));
    }

    public function getModalContent(KitItem $Kittitems)
    {

        $this->modalData = $Kittitems;
    }

    public function filterKitItem()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-item.kit-item-list-component', [
            'kitItem' => $this->getKitItem(),
        ]);
    }
}
