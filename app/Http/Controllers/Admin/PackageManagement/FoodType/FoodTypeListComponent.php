<?php

namespace App\Http\Controllers\Admin\PackageManagement\FoodType;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\FoodMaster;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class FoodTypeListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $foodtype = null, $foodtypeId, $modalData = null, $search_foodtype, $Id, $description;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getFoodType()
    {

        return FoodMaster::query()
            ->searchLike('food_type', $this->search_foodtype)
            ->desc()->paginate($this->perPage);
    }

    public function isDelete(FoodMaster $foodMaster)
    {

        $this->foodtype = $foodMaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $foodData = FoodMaster::whereId($this->foodtype);
        $foodData->delete();
        $this->alert('success', Lang::get('messages.foodtype_delete'));
    }

    public function toggleStatus(FoodMaster $foodMaster)
    {

        $this->foodtypeId = $foodMaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $foodData = FoodMaster::whereId($this->foodtypeId);
        $foodData->update(['is_active' => !$foodData->first()->is_active]);
        $this->alert('success', Lang::get('messages.foodtype_status_changed'));
    }

    public function getModalContent(FoodMaster $foodMaster)
    {

        $this->modalData = $foodMaster;
    }


    public function show(FoodMaster $foodtype)
    {   
        // dd($foodtype);

        $this->description = $foodtype->description;
        // dd($this->description);
        // $foodMasterData = FoodMaster::find($this->Id);
        // $validated['food_type'] = $foodMasterData->food_type;
        // $validated['price'] = $foodMasterData->price;
        // $validated['description'] = $foodMasterData->description;
        // FoodMaster::create($validated);
        // $this->alert('success', 'Food Type Inserted Successfully');
    }

    

    public function filterFoodTypes()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.package-management.food-type.food-type-list-component', [
            'foodtypes' => $this->getFoodType(),
        ]);
    }
}
