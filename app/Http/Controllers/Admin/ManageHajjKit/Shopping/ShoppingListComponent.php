<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\Shopping;

use Livewire\Component;
use App\Models\Shopping;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class ShoppingListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,  $shoppingId = null,$modalData,$search_shp_name,$shp_name,$shopping_modal_data;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getShoppings()
    {
        return Shopping::query()
            ->searchLike('shp_name', $this->search_shp_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(Shopping $shopping)
    {
        // dd($Shopping);
        $this->shoppingId = $shopping->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->blogId);
        $shoppingData = Shopping::whereId($this->shoppingId);
        // dd($blogData);
        $shoppingData->update(['is_active' => !$shoppingData->first()->is_active]);
        $this->alert('success', Lang::get('messages.shopping_status_changed'));
    }

    public function isDelete(Shopping $shopping)
    {
        // dd($blogs);
        $this->shoppingId = $shopping->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $shoppingData = Shopping::whereId($this->shoppingId);
        //   dd($blogData);
        $shoppingData->delete();
        $this->alert('success', Lang::get('messages.shopping_delete'));
    }

    public function getModalContent(Shopping $shopping)
    {

        $this->modalData = $shopping;
    }

    public function getContent(Shopping $shopping)
    {
        $this->shopping_modal_data = $shopping;
    }


    public function filterShopping()
    {
        $this->resetPage();
    }
    public function render()
    {
        return view('admin.manage-hajj-kit.shopping.shopping-list-component', [
            'Shoppings' => $this->getShoppings(),
        ]);
    }
}
