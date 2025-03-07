<?php

namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use App\Models\HotelMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class HotelListComponent extends Component
{
    use WithPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public $perPage = 10, $search_hotel, $search_city, $hotelMasterId, $hotelMasterDlt, $modalData;

    public function getHotel()
    {
        return HotelMaster::query()
            ->desc()
            ->searchLike('hotel_name', $this->search_hotel)
            ->SearchCity($this->search_city)
            ->paginate($this->perPage);
    }

    public function toggleStatus(HotelMaster $hotelMaster)
    {
        $this->hotelMasterId = $hotelMaster->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $hotelMasterData = HotelMaster::whereId($this->hotelMasterId);
        $hotelMasterData->update(['is_active' => !$hotelMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.hotel_status_changed'));
    }

    public function isDelete(HotelMaster $hotelmaster)
    {
        $this->hotelMasterDlt = $hotelmaster->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $flightData = HotelMaster::whereId($this->hotelMasterDlt);
        $flightData->delete();
        $this->alert('success', Lang::get('messages.hotel_delete'));
    }

    public function getModalContent(HotelMaster $hotelMasterModal)
    {
        $this->modalData = $hotelMasterModal;
    }

    public function filterHotel()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.package-management.hotel.hotel-list-component', [
            'Hotels' => $this->getHotel()
        ]);
    }
}
