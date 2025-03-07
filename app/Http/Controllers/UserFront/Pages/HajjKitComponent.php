<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\KitCategory;


class HajjKitComponent extends Component
{
    public $kit, $id, $kit_qty = 0, $tot_price = 0, $kit_names, $kit_price;

    public function mount($slug)
    {
        // dd($slug);
        $this->kit = KitCategory::where('slug', $slug)->first();
        $this->kit_names = $this->kit->getKitItemsNames();
        $this->kit_price = $this->kit->price;
    }
    public function qtyAdd()
    {
        $this->kit_qty++;

        $this->tot_price =  $this->kit_qty * $this->kit->price;
    }
    public function qtySubstract()
    {
        if ($this->kit_qty > 0) {
            $this->kit_qty--;

            $this->tot_price =  $this->kit_qty * $this->kit->price;
        }
    }
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.hajj-kit-component');
    }
}
