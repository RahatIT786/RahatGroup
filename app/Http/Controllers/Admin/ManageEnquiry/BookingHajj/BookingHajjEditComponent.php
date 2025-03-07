<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingHajj;


use App\Models\ServiceType;

use App\Models\Bookingenquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class BookingHajjEditComponent extends Component
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

    public function mount(Bookingenquiry $bookinghajj)
    {
        $this->manageHajjtId = $bookinghajj->id;
        $this->cust_name = $bookinghajj->cust_name;
        $this->cust_email = $bookinghajj->cust_email;
        $this->cust_num = $bookinghajj->cust_num;
        $this->travel_date = $bookinghajj->travel_date;
        $this->support_team = $bookinghajj->support_team;
        $this->food = $bookinghajj->food;
        $this->visa = $bookinghajj->visa;
        $this->air_ticket = $bookinghajj->air_ticket;
        $this->cat_id = $bookinghajj->cat_id;
        $this->pkg_type_id = $bookinghajj->pkg_type_id; // Initialize pkg_type_id
        $this->servicetype = ServiceType::pluck('name', 'id');

        // $this->servicetypes = ServiceType::pluck('name', 'id');
       
    }

    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Bookingenquiry::whereId($this->manageHajjtId)->update([
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

        $this->alert('success', Lang::get('messages.bookinghajj_updated', [
            'timer' => 5000,
        ]));
        return redirect()->route('admin.bookingumrah.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.booking-hajj.booking-hajj-edit-component');
    }
}
