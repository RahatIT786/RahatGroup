<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Country;

class IntTourPackagesComponent extends Component
{
    public function getTourCountry()
    {
        return Country::active()->asc('countryname')->get();
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.int-tour-packages-component', [
            'countries' => $this->getTourCountry()
        ]);
    }
}
