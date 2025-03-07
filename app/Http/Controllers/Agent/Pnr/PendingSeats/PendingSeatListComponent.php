<?php

namespace App\Http\Controllers\Agent\Pnr\PendingSeats;

use App\Models\City;
use App\Models\Pnr;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PendingSeatListComponent extends Component
{
    use WithPagination, LivewireAlert;

    public $perPage = 10;
    public $cityData;
    public $city_id;
    public $month;
    public $start_date;
    public $end_date;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->cityData = City::whereIn('id', Pnr::select('dept_city_id')->distinct()->pluck('dept_city_id'))
        ->pluck('city_name', 'id')
        ->toArray();
    }

    public function getPnrList()
    {
        $current_year = date('Y');
        $currMonth = $this->month < 10 ? "0" . $this->month : $this->month;
        $this->start_date = "$current_year-$currMonth-01";
        $this->end_date = date('Y-m-t', strtotime($this->start_date));

        return Pnr::with('flight') // Eager load flightdetails relationship
            ->search('dept_city_id', $this->city_id)
            ->where('dept_date' , '>=', now()->toDateString()) 
            ->when(!empty($this->month) && !empty($this->start_date) && !empty($this->end_date), function($q) {
                $q->whereBetween('dept_date', [$this->start_date, $this->end_date]);
            })
            ->desc()
            ->paginate($this->perPage);
    }


    public function changeInput()
    {
        //
    }
    public function pendingSeatData()
    {
        $this->validate([
            'city_id' => 'required',
            'month' => 'required',
        ], [
            'city_id.required' => 'Please select a City Name',
            'month.required' => 'Please select a Month',
        ]);
    }

    public function filterPnr()
    {
        $this->resetPage();
    }

    public function filterBookings()
    {
        //
    }



   


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.pnr.pending-seats.pending-seat-list-component', [

            'pendingSeat' => $this->getPnrList(),
        ]);
    }
}
