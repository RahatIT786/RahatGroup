<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\FoodMaster;

class FoodMenuComponent extends Component
{

    public function getFoodMenu()
    {

        $foodMenu = FoodMaster::active()->desc()->with('foodimage')->get();
        // dd($foodMenu);
        return $foodMenu;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        // dd($this->getFoodMenu());
        return view('user.pages.food-menu-component', [
            'Foods' => $this->getFoodMenu()
        ]);
    }
}
