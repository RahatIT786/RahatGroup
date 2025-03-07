<?php

namespace App\Http\Controllers\Admin\ManageTransport\ManageCarRental;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Cars;
use Illuminate\Support\Facades\Log;

class CarRentalListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $car = null, $carId, $modalData = null, $car_type, $Id;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getCars()
    {

        return Cars::query()
            ->with('cartypemaster', 'carsectormaster')
            ->searchCarTypeMaster($this->car_type)
            ->desc()->paginate($this->perPage);
    }
    public function isDelete(Cars $cars)
    {

        $this->car = $cars->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $carData = Cars::whereId($this->car);
        $carData->delete();
        $this->alert('success', Lang::get('messages.car_delete'));
    }

    public function toggleStatus(Cars $cars)
    {

        $this->carId = $cars->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $carData = Cars::whereId($this->carId);
        $carData->update(['is_active' => !$carData->first()->is_active]);
        $this->alert('success', Lang::get('messages.car_status_changed'));
    }

    public function getModalContent(Cars $cars)
    {

        $this->modalData = $cars;
    }

    public function filterCars()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-transport.manage-car-rental.car-rental-list-component', [
            'Cars' => $this->getCars(),
        ]);
    }
}
