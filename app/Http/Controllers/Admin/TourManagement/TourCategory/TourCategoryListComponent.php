<?php

namespace App\Http\Controllers\Admin\TourManagement\TourCategory;

use Livewire\Component;
use App\Models\TourCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class TourCategoryListComponent extends Component
{
    use LivewireAlert, WithPagination;

    public $perPage = 10;
    public $search_catname, $tourcategorieId, $cat_name,$modalData;
    public $is_edit = false;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getTourCategory()
    {
        return TourCategory::query()
            ->searchLike('cat_name', $this->search_catname)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterTourCategory()
    {
        $this->resetPage();
    }

    public function getModalContent(TourCategory $tourcategorie)
    {
        $this->modalData = $tourcategorie;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        TourCategory::create($validatedData);
        $this->alert('success', Lang::get('messages.tourcategory_save'));

        return redirect()->route('admin.tourCategory.index');
    }

    public function resetForm()
    {
        $this->reset(['cat_name']);
        $this->resetValidation();
    }

    public function edit(TourCategory $tourcategorie)
    {
        $this->resetValidation();
        $this->is_edit = true;
        $this->tourcategorieId = $tourcategorie->id;
        $this->cat_name = $tourcategorie->cat_name;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        TourCategory::whereId($this->tourcategorieId)->update($validatedData);
        $this->alert('success', Lang::get('messages.tourcategory_update'));
        // $this->dispatchBrowserEvent('close-modal', ['modal' => 'crudModal']);
        $this->is_edit = false;
        return redirect()->route('admin.tourCategory.index');
    }

    public function isDelete(TourCategory $tourcategorie)
    {
        $this->tourcategorieId = $tourcategorie->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $tourCategory = TourCategory::find($this->tourcategorieId);
        if ($tourCategory) {
            $tourCategory->delete();
            $this->alert('success', Lang::get('messages.tourcategory_delete'));
        }
    }

    public function render()
    {
        return view('admin.tour-management.tour-category.tour-category-list-component', [
            'tourcategories' => $this->getTourCategory(),
        ]);
    }
}
