<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agency;
use App\Models\Country;
use App\Models\State;

class AgencyListComponent extends Component
{
    public $search_country,$search_state,$search_city,$search_agency_name,$search_owner_name,$countries,$states;

    public function mount()
    {

        $this->countries = Country::all()->pluck('countryname', 'id');
        $this->states = State::all()->pluck('state_name', 'id');
        // $this->faqs = Faq::orderByDesc('id')->get();

        // $this->agencies = Agency::where('is_active', true)
        //                  ->orderByDesc('id')
        //                  ->get();
    }

    public function getAgency()
    {
        return Agency::query()
        ->searchLike('country_id', $this->search_country)
        ->searchLike('state_id', $this->search_state)
        ->searchLike('city', $this->search_city)
        ->searchLike('agency_name', $this->search_agency_name)
        ->searchLike('owner_name', $this->search_owner_name)
        ->where('is_active', true)
        ->desc()
        ->get();
    }

    public function changeInput()
    {
       //
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.agency-list-component', [
            'agencies' => $this->getAgency()
        ]);
    }
}
