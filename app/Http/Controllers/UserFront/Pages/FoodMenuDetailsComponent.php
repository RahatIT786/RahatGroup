<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\FoodMaster;
use App\Models\PackageType;

class FoodMenuDetailsComponent extends Component
{
    public $food;

    public function mount($id)
    {
        $this->food = FoodMaster::active()->desc()->where('id', $id)->with('foodimage_breakfast')->first();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.food-menu-details-component');
    }
}
