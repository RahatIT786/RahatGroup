<?php

namespace App\Http\Controllers\UserFront\Pages;

use App\Models\Publication;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PublicationListComponent extends Component
{
    public $publications, $shp, $id, $shp_qty = 0, $tot_price = 0, $publication_details = [], $grand_total = 0,$modalData;

    public function mount()
    {
        $this->publications = Publication::active()->desc()->get();

        foreach ($this->publications as $key => $publication) {
            $this->publication_details[$key]['price'] = $publication->price;
            $this->publication_details[$key]['qty'] = 0;
            $this->publication_details[$key]['tot_price'] = 0;
            // $this->publication_details['grand_total'] = 0;
        }
        // dd($this->publication_details);
    }

    public function qtyAdd($key)
    {

        $this->publication_details[$key]['qty']++;
        $this->publication_details[$key]['tot_price'] =  $this->publication_details[$key]['qty'] * $this->publication_details[$key]['price'];
        $this->calc_grand();
    }

    public function qtySubstract($key)
    {

        if ($this->publication_details[$key]['qty'] > 0) {
            $this->publication_details[$key]['qty']--;
            $this->publication_details[$key]['tot_price'] =  $this->publication_details[$key]['qty'] * $this->publication_details[$key]['price'];
        }
        $this->calc_grand();
    }
    public function calc_grand()
    {
        $grand = 0;
        foreach ($this->publication_details as $detail) {

            $grand += $detail['tot_price'];
        }
        $this->grand_total = $grand;
    }


    public function getModaldescription($key)
    {
        $this->modalData = Publication::findOrFail($key);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.publication-list-component');
    }
}
