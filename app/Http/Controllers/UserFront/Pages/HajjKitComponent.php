<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\KitCategory;


class HajjKitComponent extends Component
{
    public $kit, $id, $kit_qty = 0, $tot_price = 0, $kit_names, $kit_price, $kits;

    // public function mount($slug)
    // {
    //     // dd($slug);
    //     // $this->kit = KitCategory::where('slug', $slug)->first();
    //     // $this->kit_names = $this->kit->getKitItemsNames();
    //     // $this->kit_price = $this->kit->price;
    //     $this->kit = KitCategory::where('category_id', $slug)->get();
    //     dump($this->kit);
    //     $this->kit_names = $this->kit->getKitItemsNames();
    //     dump($this->kit_names);
    //     // $this->kit_price = $this->kit->price;
    // }
    public function mount($slug)
    {
        // Fetch all KitCategory items with the given category_id
        $this->kits = KitCategory::where('category_id', $slug)->get();
       // dd($this->kits);
        // Initialize an array to hold kit names for each kit
        $this->kit_names = [];

        // Loop through each kit and get the kit items names
        foreach ($this->kits as $kit) {
            $this->kit_names[$kit->id] = $kit->getKitItemsNames();
        }

        // Debugging: Dump the data to check
        // dump($this->kits);
        // dump($this->kit_names);
    }
    public function qtyAdd($kitId)
    {
        $this->kit_qty++;

        $kit = $this->kits->firstWhere('id', $kitId);
        if ($kit) {
            $this->tot_price = $this->kit_qty * $kit->price;
        }
        //$this->tot_price =  $this->kit_qty * $this->kits->first()->price;
    }
    public function qtySubstract($kitId)
    {
        if ($this->kit_qty > 0) {
            $this->kit_qty--;

            $kit = $this->kits->firstWhere('id', $kitId);
            if ($kit) {
                $this->tot_price = $this->kit_qty * $kit->price;
            }
        }
    }
    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.hajj-kit-component');
    }
}
