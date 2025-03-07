<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Shopping;

class ShoppingComponent extends Component
{
    public $shoppings, $shp, $id, $shp_qty = 0, $tot_price = 0, $shopping_details = [], $grand_total = 0;

    public function mount()
    {
        $this->shoppings = Shopping::active()->desc()->get();

        foreach ($this->shoppings as $key => $shopping) {
            $this->shopping_details[$key]['price'] = $shopping->price;
            $this->shopping_details[$key]['qty'] = 0;
            $this->shopping_details[$key]['tot_price'] = 0;
            // $this->shopping_details['grand_total'] = 0;
        }
        // dd($this->shopping_details);
    }

    public function qtyAdd($key)
    {

        $this->shopping_details[$key]['qty']++;
        $this->shopping_details[$key]['tot_price'] =  $this->shopping_details[$key]['qty'] * $this->shopping_details[$key]['price'];
        $this->calc_grand();
    }

    public function qtySubstract($key)
    {

        if ($this->shopping_details[$key]['qty'] > 0) {
            $this->shopping_details[$key]['qty']--;
            $this->shopping_details[$key]['tot_price'] =  $this->shopping_details[$key]['qty'] * $this->shopping_details[$key]['price'];
        }
        $this->calc_grand();
    }
    public function calc_grand()
    {
        $grand = 0;
        foreach ($this->shopping_details as $detail) {

            $grand += $detail['tot_price'];
        }
        $this->grand_total = $grand;
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.shopping-component');
    }
}
