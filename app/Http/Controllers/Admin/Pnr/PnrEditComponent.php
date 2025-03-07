<?php

namespace App\Http\Controllers\Admin\Pnr;

use App\Models\City;
use App\Models\FlightMaster;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\PackageDetails;
use App\Models\Pnr;
use App\Models\SectorMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class PnrEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $pack_id = [];
    public $packageTypes, $flights, $citys, $sectorData, $group_no, $contact_no, $rawda_permit, $sub_agent_name;
    public $pnr_code, $group_name, $flight_id, $dept_city_id, $flight_type, $departure_sector, $return_sector, $pnr_pack_type, $dept_date, $dept_time, $return_date, $return_time, $days, $seats, $avai_seats, $tour_leader, $supp_name, $transco_name, $mobno_tc, $adult_cost, $child_cost, $infant_cost, $itenary, $baggage, $cancel_fee, $transport_brn, $status;
    public $dept_time_hour, $dept_time_minute, $return_time_hour, $return_time_minute;
    public $id;
    public function mount(Pnr $pnr)
    {
        $this->id = $pnr->id;
        $this->pnr_code = $pnr->pnr_code;
        $this->pack_id = explode(',', $pnr->pack_id);
        $this->group_name = $pnr->group_name;
        $this->flight_id = $pnr->flight_id;
        $this->dept_city_id = $pnr->dept_city_id;
        $this->flight_type = $pnr->flight_type;
        $this->departure_sector = $pnr->departure_sector;
        $this->return_sector = $pnr->return_sector;
        $this->pnr_pack_type = $pnr->pnr_pack_type;
        $this->dept_date = $pnr->dept_date;
        $this->dept_time = $pnr->dept_time;
        $this->return_date = $pnr->return_date;
        $this->return_time = $pnr->return_time;
        $this->days = $pnr->days;
        $this->seats = $pnr->seats;
        $this->group_no = $pnr->group_no;
        $this->contact_no = $pnr->contact_no;
        $this->sub_agent_name = $pnr->sub_agent_name;
        $this->rawda_permit = $pnr->rawda_permit;
        $this->avai_seats = $pnr->avai_seats;
        $this->tour_leader = $pnr->tour_leader;
        $this->supp_name = $pnr->supp_name;
        $this->transco_name = $pnr->transco_name;
        $this->mobno_tc = $pnr->mobno_tc;
        $this->adult_cost = $pnr->adult_cost;
        $this->child_cost = $pnr->child_cost;
        $this->infant_cost = $pnr->infant_cost;
        $this->itenary = $pnr->itenary;
        $this->baggage = $pnr->baggage;
        $this->cancel_fee = $pnr->cancel_fee;
        $this->transport_brn = $pnr->transport_brn;
        $this->status = $pnr->is_active;
        $this->packageTypes = Packages::where('service_id', 2)->where('umrah_type', 1)->orwhere('service_id', 20)->pluck('name', 'id');
        $this->flights = FlightMaster::pluck('flight_name', 'id');
        $this->citys = City::pluck('city_name', 'id');
        $this->sectorData = SectorMaster::pluck('sector_name', 'id');

        $this->daysCounts();
    }

    public function update()
    {
        $validated = $this->validate([
            'pnr_code' => 'required',
            'pack_id' => 'required|array',
            // 'pack_id' => 'required',
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
            'group_no' => 'group number',
            'contact_no' => 'contact number',
            'sub_agent_name' => 'subagent name',
            'avai_seats' => 'available seats',
            'tour_leader' => 'package leader',
            'supp_name' => 'supplier name',
            'transco_name' => 'transport company name',
            'mobno_tc' => 'Transport Company Phone',
            'return_date.after' => 'The return date must be a date after the departure date.',
        ]);
        $validated['pack_id'] = implode(',', $this->pack_id);
        $validated['is_active'] = $this->status ?? 1;

        $pnr = Pnr::find($this->id);
        $pnr->update($validated);

        $this->alert('success', Lang::get('messages.pnr_update'));
        return redirect()->route('admin.pnr.index');
    }

    public function daysCounts()
    {
        // dd($this->dept_date , $this->return_date);
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


    public function hideForm($value)
    {
        $this->pack_id = Packages::whereIn('id', $value)->pluck('id')->toArray();
    }



    public function render()
    {
        return view('admin.pnr.pnr-edit-component');
    }
}
