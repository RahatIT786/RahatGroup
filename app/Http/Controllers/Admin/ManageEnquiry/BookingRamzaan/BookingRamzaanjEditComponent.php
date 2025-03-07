<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingRamzaan;

use App\Models\ServiceType;

use App\Models\Bookingenquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class BookingRamzaanjEditComponent extends Component
{
    public $manageEnquirietId,$cust_name,$cust_email,$cust_num,$travel_date,$food,$visa,$air_ticket,$cat_id,$pkg_type_id,$servicetype,$support_team;
    protected $rules = [
        'cust_name' => 'required',
        'cust_email' => 'required|email',
        'cust_num' => 'required',
        'travel_date' => 'required',
        'food' => 'required',
        'visa' => 'required',
        'air_ticket' => 'required',
        'cat_id' => 'required',
        'pkg_type_id' => 'required', // Add validation rule for pkg_type_id
        'support_team' => 'required',
    ];

    public function mount(Bookingenquiry $bookingramzaan)
    {
        $this->manageRamzaanId = $bookingramzaan->id;
        $this->cust_name = $bookingramzaan->cust_name;
        $this->cust_email = $bookingramzaan->cust_email;
        $this->cust_num = $bookingramzaan->cust_num;
        $this->travel_date = $bookingramzaan->travel_date;
        $this->support_team = $bookingramzaan->support_team;
        $this->food = $bookingramzaan->food;
        $this->visa = $bookingramzaan->visa;
        $this->air_ticket = $bookingramzaan->air_ticket;
        $this->cat_id = $bookingramzaan->cat_id;
        $this->pkg_type_id = $bookingramzaan->pkg_type_id; // Initialize pkg_type_id
        $this->servicetype = ServiceType::pluck('name', 'id');

        // $this->servicetypes = ServiceType::pluck('name', 'id');
       
    }

    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Bookingenquiry::whereId($this->manageRamzaanId)->update([
            'pkg_type_id' => $this->pkg_type_id,
            'cust_name' => $this->cust_name,
            'cust_email' => $this->cust_email,
            'cust_num' => $this->cust_num,
            'travel_date' => $this->travel_date,
            'support_team' => $this->support_team,
            'food' => $this->food,
            'visa' => $this->visa,
            'air_ticket' => $this->air_ticket,
            'cat_id' => $this->cat_id,
        ]);

        $this->alert('success', Lang::get('messages.bookingramzaan_updated', [
            'timer' => 5000,
        ]));
        return redirect()->route('admin.bookingramzaan.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.booking-ramzaan.booking-ramzaanj-edit-component');
    }
}
