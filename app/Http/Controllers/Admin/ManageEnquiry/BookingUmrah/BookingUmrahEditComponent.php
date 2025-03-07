<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingUmrah;

use App\Models\Bookingenquiry;
use App\Models\ServiceType;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;


class BookingUmrahEditComponent extends Component
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

    public function mount(Bookingenquiry $bookingenquiry)
    {
        $this->manageEnquirietId = $bookingenquiry->id;
        $this->cust_name = $bookingenquiry->cust_name;
        $this->cust_email = $bookingenquiry->cust_email;
        $this->cust_num = $bookingenquiry->cust_num;
        $this->travel_date = $bookingenquiry->travel_date;
        $this->support_team = $bookingenquiry->support_team;
        $this->food = $bookingenquiry->food;
        $this->visa = $bookingenquiry->visa;
        $this->air_ticket = $bookingenquiry->air_ticket;
        $this->cat_id = $bookingenquiry->cat_id;
        $this->pkg_type_id = $bookingenquiry->pkg_type_id; // Initialize pkg_type_id
        $this->servicetype = ServiceType::pluck('name', 'id');

        // $this->servicetypes = ServiceType::pluck('name', 'id');
       
    }

    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Bookingenquiry::whereId($this->manageEnquirietId)->update([
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

        $this->alert('success', Lang::get('messages.bookingumrah_updated', [
            'timer' => 5000,
        ]));
        return redirect()->route('admin.bookingumrah.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.booking-umrah.booking-umrah-edit-component');
    }
}
