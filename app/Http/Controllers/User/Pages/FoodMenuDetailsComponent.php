<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\FoodMaster;

class FoodMenuDetailsComponent extends Component
{
    public $food;

    public function mount($id)
    {
        $this->food = FoodMaster::active()->desc()->where('id', $id)->with('foodimage_breakfast')->first();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.food-menu-details-component');
    }
}
