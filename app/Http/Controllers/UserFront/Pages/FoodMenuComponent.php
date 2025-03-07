<?php

namespace App\Http\Controllers\UserFront\Pages;

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

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.food-menu-component', [
            'Foods' => $this->getFoodMenu()
        ]);
    }
}
