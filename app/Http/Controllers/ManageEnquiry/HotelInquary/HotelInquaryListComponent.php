<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\HotelInquary;

use Livewire\Component;
use App\Models\HotelEnquiries;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class HotelInquaryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$hotelEnquiriesId, $hotelEnquiriestypeId;
    protected $listeners = ['confirmDelete'];

    public function getHotelEnquiries()
    {
            $enquiry = HotelEnquiries::query()
            ->with('hotel')
            ->desc()
            ->paginate($this->perPage);
            return $enquiry;
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
