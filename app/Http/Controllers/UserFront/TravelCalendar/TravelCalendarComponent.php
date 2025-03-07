<?php

namespace App\Http\Controllers\UserFront\TravelCalendar;

use App\Models\Booking;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TravelCalendarComponent extends Component
{
    public $events = [], $colors;


    public function mount()
    {
        // dd(auth()->user()->id);
        $results = Booking::where(function ($query) {
            $query->paid()->where('user_type', auth()->user()->id)
                ->whereNotNull('travel_date')
                ->where('travel_date', '!=', '1970-01-01');
        })
            ->orWhere(function ($query) {
                $query->where('user_type', auth()->user()->id)
                    ->whereNotNull('checkin_date')
                    ->whereNotNull('checkout_date')
                    ->where('checkout_date', '!=', '0000-00-00');
            })
            //    ->with('package.pkgDetails','packagetype')
            ->with('servicetype', 'package')
            ->select('id', 'user_type', 'booking_id', 'service_type', 'package_name', 'travel_date', 'checkin_date', 'checkout_date')
            ->get();

        // dd($results);
        foreach ($results as $result) {
            // dd($result, $result->servicetype);
            $packageName = !empty($result->package) ? $result->package->name : $result->booking_id;
            if (!is_null($result->checkin_date) && !is_null($result->checkout_date) && $result->checkout_date !== '0000-00-00') {
                $this->events[] = [
                    'title' => $result->servicetype->name . "(" . $packageName . ") ", // or any other title you want to use
                    'start' => $result->checkin_date,
                    'end' => $result->checkout_date
                ];
            } elseif (!is_null($result->travel_date)) {
                $this->events[] = [
                    'title' => $result->servicetype->name . "(" . $packageName . ") ", // or any other title you want to use
                    'start' => $result->travel_date
                ];
            }
        }

        // Sort the events by the start date
        // dd(collect($this->events)->sortBy('start')->values()->all(), $this->events);
        $this->events = collect($this->events)->sortBy('start')->values()->all();
        // dd($this->events);
    }

    #[Layout('user-front.layouts.app-authenticated')]
    public function render()
    {
        return view('user-front.travel-calendar.travel-calendar-component');
    }
}
