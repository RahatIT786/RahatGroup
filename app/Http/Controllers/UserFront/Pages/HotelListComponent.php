<?php

namespace App\Http\Controllers\UserFront\Pages;

use App\Models\HotelMaster;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;

class HotelListComponent extends Component
{
    public $hotel_id, $hotel_name;
    public $cityData;
    public $city_id, $ratings;
    public $star_rating;
    public $star_ratings = [];
    public $hotelsPerPage = 6;
    public $totalHotels = 0;


    public function mount()
    {
        $this->hotel_id = Request::query('id');
        $this->hotel_name = $hotel->hotel_name ?? '';
        $this->cityData = [
            1 => "Makkah",
            2 => "Madinah",
            25 => "Baghdad",
            42 => "Najaf",
            41 => "Karbala",
        ];
        $this->star_ratings = HotelMaster::groupBy('star_rating')->pluck('star_rating', 'star_rating')->toArray();
        $this->totalHotels = HotelMaster::count(); // Get the total number of hotels
    }

    public function gethotel()
    {
        $query = HotelMaster::with('hotelimage')
            ->searchLike('hotel_name', $this->hotel_name)
            ->when($this->city_id, function ($query) {
                return $query->where('city_id', $this->city_id);
            }, function ($query) {
                return $query->whereIn('city_id', [1, 2, 25, 42, 41]);
            })
            ->when($this->star_rating, function ($query) {
                return $query->where('star_rating', $this->star_rating);
            })
            ->Active();

        // Update the total hotels count after filtering
        $this->totalHotels = $query->count();

        return $query->take($this->hotelsPerPage)->get();
    }


    public function loadMore()
    {
        $this->hotelsPerPage += 6; // Increase the number of hotels to load
    }

    public function filterHotel()
    {
        //  dd($this->city_id);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        // dd($this->gethotel()->take(1));
        return view('user-front.pages.hotel-list-component', [
            'hotels' => $this->gethotel()
        ]);
    }
}
