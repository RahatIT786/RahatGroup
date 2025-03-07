<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\HotelInquary;

use Livewire\Component;
use App\Models\Staff;
use App\Models\HotelEnquiries;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class HotelInquaryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $hotelEnquiriesId, $cust_name, $hotel_id, $support_team, $hotelEnquiriestypeId, $staffMaster, $modalData, $modalRelationship;
    protected $listeners = ['confirmDelete'];
    public $total = 0;
    public $complete = 0;
    public $pending = 0;

    public function getHotelEnquiries()
    {
        $this->total = HotelEnquiries::count(); // Total count of HotelEnquiries
        $this->complete = HotelEnquiries::where('status', 2)->count(); // Count where status is 2
        $this->pending = $this->total - $this->complete; // Calculate pending count

        $enquiry = HotelEnquiries::query()
            ->with('hotel', 'country')
            ->searchLike('cust_name', $this->cust_name)
            ->searchHotel($this->hotel_id)
            ->desc()
            ->paginate($this->perPage);
        return $enquiry;
    }

    public function mount()
    {
        // $this->serviceTypes = ServiceType::pluck('name', 'id');
        $this->staffMaster = Staff::where('role_id', 5)
            ->get()
            ->mapWithKeys(function ($staff) {
                return [$staff->id => $staff->first_name . ' ' . $staff->last_name];
            });
    }

    public function update()
    {
        $validated = $this->validate([
            'support_team' => 'required',
        ]);

        $form_data = [
            'support_team' => $this->support_team,
            'status'    => 1
        ];
        HotelEnquiries::whereId($this->modalRelationship->id)->update($form_data);
        // dd($this->modalRelationship);
        $this->alert('success', Lang::get('messages.relationshimanager_update'));
        $this->dispatch('close-modal', modal: 'relationshipModal');
        // $this->resetPage();
        return redirect()->route('admin.hotelInquary.index');
    }


    public function getModalContent(HotelEnquiries $hotelenquiries)
    {
        $this->modalData = $hotelenquiries;
    }

    public function getModalRelationship(HotelEnquiries $hotelenquiries)
    {

        $this->modalRelationship = $hotelenquiries;
        // dd($this->modalRelationship);
        $this->support_team = $this->modalRelationship->support_team;
    }

    public function filterHotel()
    {
        $this->resetPage();
    }



    public function isDelete(HotelEnquiries $hotelEnquiries)
    {
        $this->hotelEnquiriesId = $hotelEnquiries->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $hotelEnquiriestypeId = HotelEnquiries::whereId($this->hotelEnquiriesId);
        $hotelEnquiriestypeId->delete();
        $this->alert('success', Lang::get('messages.hotel_enquiry_deleted'));
    }

    public function render()
    {
        return view('admin.manage-enquiry.hotel-inquary.hotel-inquary-list-component', [
            'hotelEnquirys' => $this->getHotelEnquiries()
        ]);
    }
}
