<?php

namespace App\Http\Controllers\Admin\Pnr;

use App\Models\City;
use App\Models\FlightMaster;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\Pnr;
use App\Models\SectorMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class PnrCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $packageNames;
    public $pack_id = [];
    public  $flights, $citys, $sectorData, $group_no, $contact_no, $rawda_permit, $sub_agent_name;
    public $pnr_code, $group_name, $flight_id, $dept_city_id, $flight_type, $departure_sector, $return_sector, $pnr_pack_type, $dept_date, $dept_time, $return_date, $return_time, $days, $seats, $avai_seats, $tour_leader, $supp_name, $transco_name, $mobno_tc, $adult_cost, $child_cost, $infant_cost, $itenary, $baggage, $cancel_fee, $transport_brn, $status, $minReturnDate;

    public function mount()
    {
        $this->packageNames = Packages::where('service_id', 2)->where('umrah_type', 1)->orwhere('service_id', 20)->pluck('name', 'id');

        
        $this->flights = FlightMaster::pluck('flight_name', 'id');
        $this->citys = City::pluck('city_name', 'id');
        $this->sectorData = SectorMaster::pluck('sector_name', 'id');
    }

    public function availSeats()
    {
        $this->avai_seats = $this->seats;
    }

    public function save()
    {
        $validated = $this->validate([
            'pnr_code' => 'required',
            'pack_id' => 'required|array',
            'group_name' => 'required',
            'flight_id' => 'required',
            'dept_city_id' => 'required',
            'flight_type' => 'required',
            'departure_sector' => 'required',
            'return_sector' => 'required',
            'pnr_pack_type' => 'required',
            'days' => 'required',
            'seats' => 'required',
            'avai_seats' => 'required',
            'adult_cost' => 'required',
            'child_cost' => 'required',
            'infant_cost' => 'required',
            'itenary' => 'required',
            'baggage' => 'required',
            'cancel_fee' => 'required',
            'return_date' => 'required|date|after:dept_date',
            'dept_date' => 'required|date',
            'dept_time' => 'required',
            'return_time' => 'required',
            'tour_leader' => 'required',
            'group_no' => 'required',
            'contact_no' => 'required',
            'rawda_permit' => 'required|date',
            'sub_agent_name' => 'required',
        ], [], [
            'pack_id' => 'package name',
            'flight_id' => 'flight name',
            'dept_city_id' => 'departure city',
            'days' => 'number of days',
            'seats' => 'number of seats',
            'avai_seats' => 'available seats',
            'tour_leader' => 'package leader',
            'supp_name' => 'supplier name',
            'group_no' => 'group number',
            'contact_no' => 'contact number',
            'sub_agent_name' => 'subagent name',
            'transco_name' => 'transport company name',
            'mobno_tc' => 'Transport Company Phone',
            'return_date.after' => 'The return date must be a date after the departure date.',
        ]);
        $validated['pack_id'] = implode(',', $this->pack_id);

        $validated['is_active'] = $this->status ?? 1;
        Pnr::create($validated);
        $this->alert('success', Lang::get('messages.pnr_save'));
        return redirect()->route('admin.pnr.index');
    }
    public function daysCounts()
    {

        if ($this->dept_date && $this->return_date) {
            $dept_date = Carbon::parse($this->dept_date);
            $return_date = Carbon::parse($this->return_date);
            $interval = $dept_date->diffInDays($return_date);
            $this->days = $interval;
            // if ($return_date->lt($dept_date)) {
            $this->validate([
                'dept_date' => 'required|date',
                'return_date' => 'required|date|after:dept_date',
            ], [
                'return_date.after' => 'The return date must be a date after the departure date.',
            ]);
            // }
        }
    }
    public function render()
    {
        return view('admin.pnr.pnr-create-component');
    }
}
