<?php

namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use App\Models\HotelMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\Helper;
use App\Models\PackageDetails;

class HotelListComponent extends Component
{
    use WithPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public $perPage = 10, $search_hotel, $search_city, $hotelMasterId, $hotelMasterDlt, $modalData;
    public $hotel_city;

    public function mount()
    {
        $this->hotel_city = Helper::hotelCity();
    }
    public function getHotel()
    {
        return HotelMaster::query()
            ->desc()
            ->searchLike('hotel_name', $this->search_hotel)
            ->SearchCity('city_id', $this->search_city)
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

    // public function isDelete(HotelMaster $hotelmaster)
    // {
    //     $this->hotelMasterDlt = $hotelmaster->id;
    //     $this->confirm('Are you sure to delete this?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmDelete',
    //     ]);
    // }

    // public function confirmDelete()
    // {
    //     $flightData = HotelMaster::whereId($this->hotelMasterDlt);
    //     $flightData->delete();
    //     $this->alert('success', Lang::get('messages.hotel_delete'));
    // }

    public function isDelete($hotelMasterId)
    {
        // Find the hotel
        $hotelMaster = HotelMaster::find($hotelMasterId);

        if (!$hotelMaster) {
            $this->alert('error', 'Hotel not found.');
            return;
        }

        // Check if the hotel is not associated with any package in Makkah or Madinah
        $isAssociatedWithPackage = (
            ($hotelMaster->city_id == 1 && PackageDetails::where('makka_hotel_id', $hotelMaster->id)->exists()) ||
            ($hotelMaster->city_id == 2 && PackageDetails::where('madina_hotel_id', $hotelMaster->id)->exists())
        );

        if ($isAssociatedWithPackage) {
            // Hotel is associated with a package, do not delete
            $this->alert('error', 'Cannot delete this hotel. It is associated with a booked package.');
        } else {
            // Hotel is not associated with any package, proceed with deletion
            $hotelMaster->delete();
            $this->alert('success', 'Hotel has been deleted successfully.');
        }
    }


    public function confirmedDelete()
    {
        // Retrieve the hotel using the stored hotelMasterId
        $hotelMaster = HotelMaster::find($this->hotelMasterId);

        if ($hotelMaster) {
            $hotelMaster->delete();
            $this->alert('success', 'Hotel has been deleted successfully.');
        } else {
            $this->alert('error', 'Hotel not found.');
        }
    }


    public function getModalContent(HotelMaster $hotelMasterModal)
    {
        $this->hotel_city = Helper::hotelCity();
        $this->modalData = $hotelMasterModal;
        $this->modalData['city_name'] = $this->hotel_city[$hotelMasterModal->city_id] ?? '---';
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
