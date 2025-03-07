<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\HotelMaster;
use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;


class HotelListingComponent extends Component
{
    public $cityData;
    public $city_id,$ratings;
    public $star_rating;
    public $star_ratings = [];
	public $hotel_name;
    public $hotelsPerPage = 6;
    public $totalHotels = 0;

    public function mount()
    {
        $this->hotel_id = Request::query('id');
        $this->hotel_name = $hotel->hotel_name ?? '';
        $this->cityData = HotelMaster::select('city_id')
            ->distinct()
            ->with('city')
            ->get()
            ->pluck('city.city_name', 'city_id')
            ->toArray();

            $this->cityData = [ 1 => "Makkah",
                                2 => "Madinah",
                                25 => "Baghdad",
                                42 => "Najaf",
                                41 => "Karbala",
                                ];

        $this->star_ratings = HotelMaster::groupBy('star_rating')->pluck('star_rating', 'star_rating')->toArray();
        $this->totalHotels = HotelMaster::count();
    }
    public function gethotel()
    {
        return HotelMaster::with('hotelimage')
            ->searchLike('hotel_name', $this->hotel_name)
            // ->searchLike('star_rating', $this->star_rating)
            ->when($this->city_id, function ($query) {
                return $query->where('city_id', $this->city_id);
            }, function ($query) {
                return $query->whereIn('city_id', [1, 2, 25 , 42 , 41]);
            })
            ->when($this->star_rating, function ($query) {
                return $query->where('star_rating', $this->star_rating);
            })
            ->take($this->hotelsPerPage)
            ->get();
    }

    public function loadMore()
    {
        $this->hotelsPerPage += 6; // Increase the number of hotels to load
    }
    public function changeInput()
    {
        // dd($this->city_id);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {

        // dd($this->gethotel());
        return view('user.pages.hotel-listing-component', [
            'hotels' => $this->gethotel()
        ]);
    }
}
