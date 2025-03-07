<?php

namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use Livewire\Component;
use App\Models\HotelMaster;
use App\Models\HotelRoomImage;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HotelRoomImageComponent extends Component
{
    public $hotel_id, $room_img, $id;
    public $standard_room_image;
    public $deluxe_room_image;
    use LivewireAlert;
    use WithFileUploads;

    public function mount($hotel)
    {

        $this->hotel_id = $hotel;
        // dd($hotel);
       
    }

    
   
    public function save()
    {
        //  dd($this->standard_room_image);
        $validated = $this->validate([
            'standard_room_image' => 'required|max:1024',
            'deluxe_room_image' => 'required|max:1024',

        ]);
        //  dd($validated);

        $standardImageName = Str::uuid() . '.' . $validated['standard_room_image']->getClientOriginalExtension();
        if (Storage::putFileAs('public/hotel_room_images', $validated['standard_room_image'], $standardImageName)) {
            HotelRoomImage::create([
                'hotel_id'  => $this->hotel_id,
                'room_type' => 1,
                'room_img'  => $standardImageName,
            ]);
        }

        $deluxeImageName = Str::uuid() . '.' . $validated['deluxe_room_image']->getClientOriginalExtension();
        if (Storage::putFileAs('public/hotel_room_images', $validated['deluxe_room_image'], $deluxeImageName)) {
            HotelRoomImage::create([
                'hotel_id'  => $this->hotel_id,
                'room_type' => 1,
                'room_img'  => $deluxeImageName,
            ]);
        }

        $this->alert('success', Lang::get('messages.hotel_room_save'));
        return to_route('admin.hotel.index');
    }


    public function show(HotelRoomImage $hotel)
    {

        $this->id = $hotel->id;
        $this->deluxe_room_image = $hotel->room_img;
        $this->standard_room_image = $hotel->room_img;

    }


    public function render()
    {
        return view('admin.package-management.hotel.hotel-room-image-component');
    }
}
