<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\KitCategory;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\KitCategory;
use App\Models\KitItem;

class KitCategoryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $name, $kit_category_img, $price, $description, $search_name, $categoryId = null, $modalData = null;
    protected $listeners = ['confirmed', 'confirmDelete'];


    public function getKitCategory()
    {
        return KitCategory::query()
            // ->with('kitItems')
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterKitCategory()
    {
        $this->resetPage();
    }

    public function getModalContent(KitCategory $kitCategory)
    {
        $this->modalData = $kitCategory;
    }

    public function toggleStatus(KitCategory $kitCategory)
    {
        // dd($service);
        $this->categoryId = $kitCategory->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->categoryId);
        $categoryData = KitCategory::whereId($this->categoryId);
        // dd($bannerData);
        $categoryData->update(['is_active' => !$categoryData->first()->is_active]);
        $this->alert('success', Lang::get('messages.kitt_category_status_changed'));
    }

    public function isDelete(KitCategory $kitCategory)
    {
        // dd($service);
        $this->categoryId = $kitCategory->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $categoryData = KitCategory::whereId($this->categoryId);
        //   dd($categoryData);
        $categoryData->delete();
        $this->alert('success', Lang::get('messages.kitt_category_delete'));
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-category.kit-category-list-component', [
            'KitCategory' => $this->getKitCategory(),
        ]);
    }
}
