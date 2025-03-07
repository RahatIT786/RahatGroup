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
use App\Helpers\Helper;
use App\Models\Country;


class HotelCreateComponent extends Component

{
    use LivewireAlert, WithFileUploads;
    public $cityData, $hotel_name, $star_rating, $city_id,$country_id, $countries,$cities = [], $distance, $contact, $email, $website_url, $check_in, $check_out, $google_map, $address, $hotel_overview, $high_start_date, $high_end_date, $high_season_price;
    public $medium_start_date, $medium_end_date, $medium_season_price, $low_start_date, $low_end_date, $low_season_price;
    public $hotel_img = [];
    public $check_in_time_hour, $check_in_time_minute;
    public $check_out_time_hour, $check_out_time_minute;
    public $video = [];


    // public function mount()
    // {
    //     $this->cityData = Helper::hotelCity();
    // }
    public function mount()
    {
        $this->cities = City::all()->pluck('city_name', 'id');
        $this->countries = Country::all()->pluck('countryname', 'id');
    }
    public function changeCountry()
    {
        $this->cities = City::where('country_id', $this->country_id)->pluck('city_name', 'id');
        $this->city_id = null;
        // dd($this->cities);
    }

    public function addVideo()
{
    $this->video[] = '';
}


    public function removeVideo($index)
    {
        unset($this->video[$index]);
        $this->video = array_values($this->video); // Reindex the array
    }

    public function save()
    {
        // dd($this->check_in,$this->check_out);
        $rules = [
            'hotel_name' => 'required',
            'star_rating' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'distance' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'website_url' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'google_map' => 'required',
            'address' => 'required',
            'hotel_overview' => 'required',
            'hotel_img.*' => 'required|image',
           'video' => 'nullable|url',
        ];

        $validationAttributes = [
            'star_rating' => 'hotel star rating',
            'city_id' => 'city',
            'country_id' => 'country',
            'distance' => 'hotel distance',
            'contact' => 'hotel contact',
            'video' => 'video URL',
        ];

        $validated = $this->validate($rules, [], $validationAttributes);

        $hotel = HotelMaster::create([
            'hotel_name' => $this->hotel_name,
            'star_rating' => $this->star_rating,
            'city_id' => $this->city_id,
            'country_id' => $this->country_id,
            'distance' => $this->distance,
            'contact' => $this->contact,
            'email' => $this->email,
            'website_url' => $this->website_url,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
            'google_map' => $this->google_map,
            'address' => $this->address,
            'hotel_overview' => $this->hotel_overview,
            'high_start_date' => $this->high_start_date,  // Save high season start date
            'high_end_date' => $this->high_end_date,      // Save high season end date
            'high_season_price' => $this->high_season_price, // Save high season price
            'medium_start_date' => $this->medium_start_date,  // Optional: Store medium season start date
            'medium_end_date' => $this->medium_end_date,      // Optional: Store medium season end date
            'medium_season_price' => $this->medium_season_price, // Optional: Store medium season price
            'low_start_date' => $this->low_start_date,  // Optional: Store low season start date
            'low_end_date' => $this->low_end_date,      // Optional: Store low season end date
            'low_season_price' => $this->low_season_price, // Optional: Store low season price
            'video' => $this->video, // Save video link
            // 'video' => $videoUrl,



        ]);

        unset($validated['country_id']);
        unset($validated['city_id']);
        $validated['country_id'] = $this->country_id;
        $validated['city_id'] = $this->city_id;

        foreach ($this->hotel_img as $photo) {

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
