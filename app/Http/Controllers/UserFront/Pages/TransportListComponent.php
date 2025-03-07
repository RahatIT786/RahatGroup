<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Cars;
use App\Models\CarSectorMaster;
use App\Models\CarTypeMaster;

class TransportListComponent extends Component
{
    public $carsectormaster, $cartypemaster, $star_rating, $car_type_id, $car_sector_id;

    public function mount()
    {
        $this->carsectormaster = CarSectorMaster::select('sector_name', 'id')->get();
        $this->cartypemaster = CarTypeMaster::select('car_type', 'id')->get();
        $this->car_sector_id = $this->carsectormaster[0]->id;
    }

    public function getcars()
    {
        return Cars::with('carimages')
            ->search('car_type_id', $this->car_type_id)
            ->search('car_sector_id', $this->car_sector_id)
            ->get();
    }

    public function filterCar()
    {
        // dd($this->car_type_id, $car_sector_id);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.transport-list-component', [
            'cars' => $this->getcars()
        ]);
    }
}
