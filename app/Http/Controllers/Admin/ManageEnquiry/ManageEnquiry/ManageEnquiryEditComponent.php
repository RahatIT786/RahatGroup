<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\ManageEnquiry;

use App\Models\Enquiry;
use App\Models\ServiceType;
use App\Models\City;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageEnquiryEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $servicetype, $city, $id, $cat_id, $city_id, $name, $email, $mobile_num, $whatsapp_num, $support_team;

    public function mount(Enquiry $manageEnquiry)
    {
        // dd($manageEnquiry);
        $this->id = $manageEnquiry->id;
        $this->cat_id = $manageEnquiry->cat_id;
        $this->city_id = $manageEnquiry->city_id;
        $this->name = $manageEnquiry->name;
        $this->email = $manageEnquiry->email;
        $this->mobile_num = $manageEnquiry->mobile_num;
        $this->whatsapp_num = $manageEnquiry->whatsapp_num;
        $this->support_team = $manageEnquiry->support_team;
        
        $this->servicetype = ServiceType::pluck('name', 'id');
        $this->city = City::pluck('city_name', 'id');

        // dd( $this->city);
    }  

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
           
        ]);
        Enquiry::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.enquiry_update'));
        return to_route('admin.manageEnquiry.index');
    }

    public function render()
    {
        return view('admin.manage-enquiry.manage-enquiry.manage-enquiry-edit-component');
    }
}
