<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\KitCategory;
use App\Models\KitItem;

class HajjKitListComponent extends Component
{
    public $hajkits, $shp, $id, $shp_qty = 0, $tot_price = 0, $kit_price = [], $grand_total = 0, $itemData = [], $kitData, $url_category, $pageName,$modalData;

    public function mount()
    {
        $lastSegment = request()->segment(count(request()->segments()));
        // dd($lastSegment);
        if ($lastSegment == 'hajj-kit') {
            $this->url_category = 1;
            $this->pageName = 'Hajj Kit';
        }

        if ($lastSegment == 'umrah-kit') {
            $this->url_category = 2;
            $this->pageName = 'Umrah Kit';
        }

        if ($lastSegment == 'bags-and-kit') {
            $this->url_category = null;
            $this->pageName = 'Bags & Kit';
        }

        // $this->hajkits = KitCategory::active()->desc()->get();
        // $this->hajkits = KitCategory::active()->where('category_id', 1)->desc()->get();
        $this->hajkits = KitCategory::active()->when($this->url_category, fn($q) => $q->where('category_id', $this->url_category))->desc()->get();

        foreach ($this->hajkits as $key => $hajkit) {
            $this->kit_price[$key]['price'] = $hajkit->price;
            $this->kit_price[$key]['qty'] = 0;
            $this->kit_price[$key]['tot_price'] = 0;
            // $this->kit_price['grand_total'] = 0;
        }
        // dd($this->kit_price);
    }

    public function qtyAdd($key)
    {

        $this->kit_price[$key]['qty']++;
        $this->kit_price[$key]['tot_price'] =  $this->kit_price[$key]['qty'] * $this->kit_price[$key]['price'];
        $this->calc_grand();
    }

    public function qtySubstract($key)
    {

        if ($this->kit_price[$key]['qty'] > 0) {
            $this->kit_price[$key]['qty']--;
            $this->kit_price[$key]['tot_price'] =  $this->kit_price[$key]['qty'] * $this->kit_price[$key]['price'];
        }
        $this->calc_grand();
    }

    public function calc_grand()
    {
        $grand = 0;
        foreach ($this->kit_price as $kit) {

            $grand += $kit['tot_price'];
        }
        $this->grand_total = $grand;
    }

    public function getModal($kitId)
    {
        // dd('hi');
        $this->kitData = KitCategory::active()->findOrFail($kitId);
        // dd($this->kitData);
        $this->itemData = KitItem::whereIn('id', $this->kitData->kit_item_id)->get();
        // dd($this->itemData);
    }


    public function getModaldescription($kitId)
    {
        $this->modalData = KitCategory::findOrFail($kitId);
    }


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.hajj-kit-list-component');
    }
}
