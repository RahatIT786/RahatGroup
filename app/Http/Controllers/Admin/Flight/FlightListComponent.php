<?php

namespace App\Http\Controllers\Admin\Flight;

use App\Models\FlightMaster;
use App\Models\Pnr;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class FlightListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $flightMaster = null, $flightmasterId, $modalData = null, $search_flight, $search_flight_code;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getFlightData()
    {
        return FlightMaster::query()
            ->desc()
            ->searchLike('flight_name', $this->search_flight)
            ->searchLike('flight_code', $this->search_flight_code)
            ->paginate($this->perPage);
    }

    public function isDelete(FlightMaster $flightmaster)
    {
        $this->flightMaster = $flightmaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    // public function confirmDelete()
    // {
    //     $flightData = FlightMaster::whereId($this->flightMaster);
    //     $flightData->delete();
    //     $this->alert('success', Lang::get('messages.flight_delete'));
    // }

    public function confirmDelete()
    {
        $bookings = Pnr::where('flight_id', $this->flightMaster)->exists();

        if ($bookings) {
            $this->alert('error', 'This PNR is already booked by some users, deletion is not allowed.');
        } else {
            $packageMasterData = FlightMaster::whereId($this->flightMaster)->first();

            if ($packageMasterData) {
                $packageMasterData->delete();
                $this->alert('success', 'Record has been deleted successfully');
            }
        }
    }

    public function filterFlight()
    {
        $this->resetPage();
    }

    public function toggleStatus(FlightMaster $flightmaster)
    {
        $this->flightmasterId = $flightmaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $flightMasterData = FlightMaster::whereId($this->flightmasterId);
        $flightMasterData->update(['is_active' => !$flightMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.flight_status_changed'));
    }



    public function getModalContent(FlightMaster $flightmaster)
    {
        $this->modalData = $flightmaster;
    }

    public function render()
    {
        return view('admin.flight.flight-list-component', [
            'flights' => $this->getFlightData(),
        ]);
    }
}
