<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\Cars;
use App\Models\CarSectorMaster;
use App\Models\CarTypeMaster;
use Livewire\Attributes\Layout;

class TransportListComponent extends Component
{
    public $carsectormaster, $cartypemaster, $star_rating, $car_type_id, $car_sector_id;

    public function mount()
    {
        // $this->cityData = City::select('id', 'city_name')->get();
        $this->carsectormaster = CarSectorMaster::select('sector_name', 'id')->get();
        $this->cartypemaster = CarTypeMaster::select('car_type', 'id')->get();
        $this->car_sector_id = $this->carsectormaster[0]->id;
    }

    public function getcars()
    {
        return Cars::with('carimages')
            // ->with('cartypemaster', 'carsectormaster')
            ->search('car_type_id', $this->car_type_id)
            ->search('car_sector_id', $this->car_sector_id)
            ->get();
    }

    public function filterCar()
    {
        // dd($this->car_type_id, $car_sector_id);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.transport-list-component', [
            'cars' => $this->getcars()
        ]);
    }
}
