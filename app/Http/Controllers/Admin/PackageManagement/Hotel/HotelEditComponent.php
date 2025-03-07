<?php
namespace App\Http\Controllers\Admin\PackageManagement\Hotel;

use App\Models\City;
use App\Models\HotelImage;
use App\Models\HotelMaster;
use App\Models\Country;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\Helper;

class HotelEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $id, $city;
    public $cityData, $hotel_name, $star_rating, $city_id, $country_id, $countries,$cities = [], $distance, $contact, $email, $website_url, $check_in, $check_out, $google_map, $address, $hotel_overview, $high_start_date, $high_end_date, $high_season_price;
    public $medium_start_date, $medium_end_date, $medium_season_price, $low_start_date, $low_end_date, $low_season_price, $hotel_id;
    public $hotel_img = [];
    public $check_in_time_hour, $check_in_time_minute;
    public $check_out_time_hour, $check_out_time_minute;


    public $photoEdit = [],$video;
    public $hotelId, $hotelMasterDlt;


    public function mount(HotelMaster $hotel)
    {
        $this->id = $hotel->id;
        $this->hotel_name = $hotel->hotel_name;
        $this->star_rating = $hotel->star_rating;
        $this->city_id = $hotel->city_id;
        $this->country_id = $hotel->country_id;
        $this->distance = $hotel->distance;
        $this->contact = $hotel->contact;
        $this->email = $hotel->email;
        $this->website_url = $hotel->website_url;
        $this->check_in = $hotel->check_in;
        $this->check_out = $hotel->check_out;
        $this->google_map = $hotel->google_map;
        $this->address = $hotel->address;
        $this->hotel_overview = $hotel->hotel_overview;
        $this->high_start_date = $hotel->high_start_date;
        $this->high_end_date = $hotel->high_end_date;
        $this->high_season_price = $hotel->high_season_price;
        $this->medium_start_date = $hotel->medium_start_date;
        $this->medium_end_date = $hotel->medium_end_date;
        $this->medium_season_price = $hotel->medium_season_price;
        $this->low_start_date = $hotel->low_start_date;
        $this->low_end_date = $hotel->low_end_date;
        $this->low_season_price = $hotel->low_season_price;
        $this->video = $hotel->video;





        // list($this->check_in_time_hour, $this->check_in_time_minute) = explode(':', $hotel->check_in);
        // list($this->check_out_time_hour, $this->check_out_time_minute) = explode(':', $hotel->check_out);

        // $this->existingVideos = $hotel->videos()->pluck('video')->toArray();

        // $this->cityData = Helper::hotelCity();

        $this->cities = City::all()->pluck('city_name', 'id');
        $this->countries = Country::all()->pluck('countryname', 'id');
    }






    public function changeCountry()
    {
        $this->cities = City::where('country_id', $this->country_id)->pluck('city_name', 'id');
        $this->city_id = null;
        // dd($this->cities);
    }

    public function loadExistingImages()
    {
        $hotel = HotelMaster::find($this->id);
        $this->photoEdit = HotelImage::where('hotel_id', $this->id)->pluck('hotel_img', 'id');
        // $this->photoEdit = $hotel->images->pluck('hotel_img')->toArray();
    }

    public function deleteImage($imageName)
    {
        // Delete the image file from storage
        Storage::delete('public/hotel_photo/' . $imageName);

        // Delete the image record from the database
        HotelImage::where('hotel_id', $this->id)
            ->where('hotel_img', $imageName)
            ->delete();

        // Reload the images after deletion
        $this->loadExistingImages();
    }

    public function update()
    {
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
            'hotel_img.*' => 'sometimes|image',
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

        unset($validated['country_id']);
        unset($validated['city_id']);
        $validated['country_id'] = $this->country_id;
        $validated['city_id'] = $this->city_id;
        // Find the existing hotel record by its ID
        $hotel = HotelMaster::find($this->id);
        // Update the hotel attributes



        $hotel->update([
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
            'high_start_date' => $this->high_start_date,
            'high_end_date' => $this->high_end_date,
            'high_season_price' => $this->high_season_price,
            'medium_start_date' => $this->medium_start_date,
            'medium_end_date' => $this->medium_end_date,
            'medium_season_price' => $this->medium_season_price,
            'low_start_date' => $this->low_start_date,
            'low_end_date' => $this->low_end_date,
            'low_season_price' => $this->low_season_price,
            'video' => $this->video, // Save video link

        ]);

        // Joddha start 30-07-2024
        if (isset($this->hotel_img)) {
            foreach ($this->hotel_img as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/hotel_photo', $photo, $imageName);
                HotelImage::create([
                    'hotel_id' => $hotel->id,
                    'hotel_img' => $imageName,
                ]);
            }
        }
        $this->loadExistingImages();
        // Joddha end 30-07-2024
        $this->alert('success', Lang::get('messages.hotel_update'));
        return redirect()->route('admin.hotel.index');
    }

    public function render()
    {
        return view('admin.package-management.hotel.hotel-edit-component');
    }
}
