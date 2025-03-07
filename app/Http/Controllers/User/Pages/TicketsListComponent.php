<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Pnr;
use App\Models\FlightMaster;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
class TicketsListComponent extends Component
{
    public $search_city,$cities,$search_flight,$flights,$search_dept_date,$search_return_date;
    public $ticketPerPage = 10;
    public $totalTickets = 0;

    public function mount()
    {
        $this->search_city = Request::query('dept_city_id');
        // $this->cities = City::all()->pluck('city_name', 'id');
        $this->flights = FlightMaster::all()->pluck('flight_name', 'id');
        $this->totalTickets = Pnr::active()->count();

    }

    public function getTicket()
    {
       $queries = Pnr::query()
        ->where('dept_date', '>', Carbon::today())
        ->searchLike('dept_city_id', $this->search_city)
        ->searchLike('flight_id', $this->search_flight)
        ->searchLike('dept_date', $this->search_dept_date)
        ->searchLike('return_date', $this->search_return_date)
        ->where('is_active', true)
        ->orderBy('dept_date', 'asc') // Order by id in descending order
        ->take($this->ticketPerPage);

        $this->pnrs = $queries->get();

        // Fetch distinct city IDs and map to city names
        $this->cities = Pnr::query()
            ->select('dept_city_id') // Only fetch dept_city_id
            ->distinct()
            ->get()
            ->mapWithKeys(function ($pnr) {
                return [$pnr->dept_city_id => optional($pnr->city)->city_name];
            })
            ->toArray();

        return $this->pnrs;

    }

    public function loadMore()
    {
        $this->ticketPerPage += 10; // Increase the number of hotels to load
    }

    public function changeInput()
    {
       //
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.tickets-list-component', [
            'pnrs' => $this->getTicket()
        ]);
    }
}
