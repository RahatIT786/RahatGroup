<?php

namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use App\Models\City;
use App\Models\HotelImage;
use App\Models\HotelMaster;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class HotelEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $id, $city;
    public $cityData, $hotel_name, $star_rating, $city_id, $distance, $contact, $google_map, $address, $high_start_date, $high_end_date, $high_season_price;
    public $medium_start_date, $medium_end_date, $medium_season_price, $low_start_date, $low_end_date, $low_season_price, $photoEdit, $hotel_id;
    public $hotel_img = [];

    public function mount(HotelMaster $hotel)
    {
        $this->id = $hotel->id;
        $this->hotel_name = $hotel->hotel_name;
        $this->star_rating = $hotel->star_rating;
        $this->city_id = $hotel->city_id;
        $this->distance = $hotel->distance;
        $this->contact = $hotel->contact;
        $this->google_map = $hotel->google_map;
        $this->address = $hotel->address;
        $this->high_start_date = $hotel->high_start_date;
        $this->high_end_date = $hotel->high_end_date;
        $this->high_season_price = $hotel->high_season_price;
        $this->medium_start_date = $hotel->medium_start_date;
        $this->medium_end_date = $hotel->medium_end_date;
        $this->medium_season_price = $hotel->medium_season_price;
        $this->low_start_date = $hotel->low_start_date;
        $this->low_end_date = $hotel->low_end_date;
        $this->low_season_price = $hotel->low_season_price;

        // Ensuring $photoEdit is always an array
        // $this->photoEdit = $hotel->hotelimage->pluck('hotel_img')->toArray();
        $this->photoEdit = HotelImage::where('hotel_id', $this->id)->pluck('hotel_img', 'id');
        // dd($this->photoEdit);

        $this->city = City::pluck('city_name', 'id');
    }

    public function update()
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
            'hotel_img.*' => 'sometimes|image',
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

        // Find the existing hotel record by its ID
        $hotel = HotelMaster::find($this->id);

        // Update the hotel attributes
        $hotel->update([
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

        // Handle the image upload
        if (isset($this->hotel_img)) {
            // Delete existing images if new images are uploaded
            $existingImages = HotelImage::where('hotel_id', $hotel->id)->get();
            foreach ($existingImages as $image) {
                Storage::delete('public/hotel_photo/' . $image->hotel_img);
                $image->delete();
            }

            // Upload new images
            foreach ($this->hotel_img as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;

                $photo->storeAs('public/hotel_photo', $imageName);
                HotelImage::create([
                    'hotel_id' => $hotel->id,
                    'hotel_img' => $imageName,
                ]);
            }
        }

        $this->alert('success', Lang::get('messages.hotel_update'));
        return redirect()->route('admin.hotel.index');
    }





    public function render()
    {
        return view('admin.package-management.hotel.hotel-edit-component');
    }
}
