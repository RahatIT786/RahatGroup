<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingTour;

use App\Models\ServiceType;

use App\Models\Bookingenquiry;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class BookingTourEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $manageTourId,$cust_name,$cust_email,$cust_num,$travel_date,$food,$visa,$air_ticket,$cat_id,$pkg_type_id,$servicetype,$support_team;
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
    public function mount(Bookingenquiry $bookingtour)
    {
        $this->manageTourId = $bookingtour->id;
        $this->cust_name = $bookingtour->cust_name;
        $this->cust_email = $bookingtour->cust_email;
        $this->cust_num = $bookingtour->cust_num;
        $this->travel_date = $bookingtour->travel_date;
        $this->support_team = $bookingtour->support_team;
        $this->food = $bookingtour->food;
        $this->visa = $bookingtour->visa;
        $this->air_ticket = $bookingtour->air_ticket;
        $this->cat_id = $bookingtour->cat_id;
        $this->pkg_type_id = $bookingtour->pkg_type_id; // Initialize pkg_type_id
        $this->servicetype = ServiceType::pluck('name', 'id');

        // $this->servicetypes = ServiceType::pluck('name', 'id');
       
    }

    public function update()
    {
        $validated = $this->validate();
// dd($validated);
Bookingenquiry::whereId($this->manageTourId)->update([
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

        $this->alert('success', Lang::get('messages.bookingtour_updated', [
            'timer' => 5000,
        ]));
        return redirect()->route('admin.bookingtour.index');
    }



    public function render()
    {
        return view('admin.manage-enquiry.booking-tour.booking-tour-edit-component');
    }
}
