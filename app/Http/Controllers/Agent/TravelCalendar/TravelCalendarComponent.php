<?php

namespace App\Http\Controllers\Agent\TravelCalendar;

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
            $query->paid()->where('agency_id', auth()->user()->id)
                ->whereNotNull('travel_date')
                ->where('travel_date', '!=', '1970-01-01');
            })
            ->orWhere(function ($query) {
                $query->where('agency_id', auth()->user()->id)
                    ->whereNotNull('checkin_date')
                    ->whereNotNull('checkout_date')
                    ->where('checkout_date', '!=', '0000-00-00');
            })
            ->select('booking_id', 'mehram_name', 'checkin_date', 'checkout_date', 'travel_date')
            ->get();


        // dd($results);
        foreach ($results as $result) {
            $mehramName = $result->mehram_name ?? 'N/A'; // Default to 'N/A' if no mehram_name is available

            if (!is_null($result->checkin_date) && !is_null($result->checkout_date) && $result->checkout_date !== '0000-00-00') {
                $this->events[] = [
                    'title' =>  $result->booking_id .   "(" . $mehramName . ") ",
                    'start' => $result->checkin_date,
                    'end' => $result->checkout_date,
                    'url' => route('agent.bookings.index'),
                ];
            } elseif (!is_null($result->travel_date)) {
                $this->events[] = [
                    'title' => $result->booking_id .   "(" . $mehramName . ") ",
                    'start' => $result->travel_date,
                    'url' => route('agent.bookings.index'),
                ];
            }
        }

        // Sort the events by the start date
        // dd($this->events);
        // dd(collect($this->events)->sortBy('start')->values()->all(), $this->events);
        $this->events = collect($this->events)->sortBy('start')->values()->all();
        // dd($this->events);
    }


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.travel-calendar.travel-calendar-component');
    }
}
