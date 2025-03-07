<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\Booking;
use App\Models\Pnr;
use Livewire\Component;
use Livewire\Attributes\Layout;


class BookingCalendarComponent extends Component
{
    public $events = [], $colors;


    public function mount()
    {

        $results = Pnr::whereHas('package', function ($query) {
            $query->where('service_id', 2);
        })
        ->with('city','packages')
        ->get();
        // dd($results);
        // $results = Booking::where('servicetype', function($query) {
        //     $query->where('name', 'umrah');
        // })
        // $results = Booking::where('service_type',2)
        // ->whereNotNull('travel_date')->where('travel_date', '!=', '1970-01-01')
        // ->orWhere(function ($query) {
        //     $query->whereNotNull('checkin_date')
        //         ->whereNotNull('checkout_date')
        //         ->where('checkout_date', '!=', '0000-00-00');
        // })
        // ->with('servicetype')
        // ->select('id', 'booking_id', 'service_type', 'package_name','travel_date', 'checkin_date', 'checkout_date')
        // ->get();
    //    dd($results);
        foreach ($results as $result) {
        //    dd($result, $result->servicetype);
        $packageName = !empty($result->package) ? $result->package->name : $result->booking_id;
        $cityName = !empty($result->city) ? $result->city->city_name : null;



// Check if the 'pendingSeat' is actually an accessor on the PackageMaster model
// Ensure you have something like this in PackageMaster.php if necessary:
// public function getPendingSeatAttribute() {
//     return // some logic to calculate or return pending seat information;
// }

            // dd($packageName);
            // if (!is_null($result->checkin_date) && !is_null($result->checkout_date) && $result->checkout_date !== '0000-00-00') {
            //     $this->events[] = [
            //         'title' => $result->package->servicetype->name . "(" . $packageName . ") ", // or any other title you want to use
            //         'start' => $result->checkin_date,
            //         'end' => $result->checkout_date,
            //         'backgroundColor' => "#B49164",
            //         'textColor' => "white",
            //         'borderColor' => "#B49164",
            //     ];
            // } elseif (!is_null($result->dept_date)) {
                $this->events[] = [
                    'title' => $result->package->servicetype->name . " (" . $packageName . ")",
                    'city' => $result->city->cityName . " (" . $cityName . ")",
                    // 'seat' => $result->packages->pendingSeat . " (" . $pendingSeat . ")",
                    'start' => $result->dept_date,
                    'backgroundColor' => "#B49164",
                    'textColor' => "white",
                    'borderColor' => "#B49164",
                ];

            // }
        }
        // Sort the events by the start date
        // dd(collect($this->events)->sortBy('start')->values()->all(), $this->events);
        $this->events = collect($this->events)->sortBy('start')->values()->all();
        // dd($this->events);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.booking-calendar-component');
    }
}
