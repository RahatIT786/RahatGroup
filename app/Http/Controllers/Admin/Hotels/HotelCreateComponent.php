<?php

namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use App\Models\City;
use App\Models\HotelImage;
use App\Models\HotelMaster;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class HotelCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $cityData, $hotel_name, $star_rating, $city_id, $distance, $contact, $google_map, $address, $high_start_date, $high_end_date, $high_season_price;
    public $medium_start_date, $medium_end_date, $medium_season_price, $low_start_date, $low_end_date, $low_season_price;
    public $hotel_img = [];

    public function mount()
    {
        $this->cityData = City::pluck('city_name', 'id');
    }

    public function save()
    {
        $rules = [
            'hotel_name' => 'required',
            'star_rating' => 'required',
            'city_id' => 'required',
            'distance' => 'required',
            'contact' => 'required',
            'google_map' => 'required',
            'address' => 'required',
            'high_start_date' => 'required',
            'high_end_date' => 'required',
            'high_season_price' => 'required',
            'medium_start_date' => 'required',
            'medium_end_date' => 'required',
            'medium_season_price' => 'required',
            'low_start_date' => 'required',
            'low_end_date' => 'required',
            'low_season_price' => 'required',
            'hotel_img.*' => 'required|image',
        ];

        $validationAttributes = [
            'star_rating' => 'hotel star rating',
            'city_id' => 'city',
            'distance' => 'hotel distance',
            'contact' => 'hotel contact',
            'high_start_date' => 'high season start date',
            'high_end_date' => 'high season end date',
            'medium_start_date' => 'medium season start date',
            'medium_end_date' => 'medium season end date',
            'low_start_date' => 'low season start date',
            'low_end_date' => 'low season end date',
        ];
        $validated = $this->validate($rules, [], $validationAttributes);

        $hotel = HotelMaster::create([
            'hotel_name' => $validated['hotel_name'],
            'star_rating' => $validated['star_rating'],
            'city_id' => $validated['city_id'],
            'distance' => $validated['distance'],
            'contact' => $validated['contact'],
            'google_map' => $validated['google_map'],
            'address' => $validated['address'],
            'high_start_date' => $validated['high_start_date'],
            'high_end_date' => $validated['high_end_date'],
            'high_season_price' => $validated['high_season_price'],
            'medium_start_date' => $validated['medium_start_date'],
            'medium_end_date' => $validated['medium_end_date'],
            'medium_season_price' => $validated['medium_season_price'],
            'low_start_date' => $validated['low_start_date'],
            'low_end_date' => $validated['low_end_date'],
            'low_season_price' => $validated['low_season_price'],
        ]);
        // dd($this->hotel_img);
        foreach ($this->hotel_img as $photo) {
            // dd($photo);
            $uuid = Str::uuid();
            $imageExtension = $photo->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $photo->storeAs('public/hotel_photo', $imageName);
            HotelImage::create([
                'hotel_id' => $hotel->id,
                'hotel_img' => $imageName,
                'is_active' => 1,
            ]);
        }
        $this->alert('success', Lang::get('messages.hotel_save'));
        return redirect()->route('admin.hotel.index');
    }

    public function render()
    {
        return view('admin.package-management.hotel.hotel-create-component');
    }
}
