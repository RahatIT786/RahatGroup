<?php

namespace App\Http\Controllers\Admin\ManageEnquiry\BookingRamzaan;

use App\Models\Bookingenquiry;
use App\Models\ServiceType;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BookingRamzaanjListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$typesId,$search_name;
    protected $listeners = ['confirmed', 'confirmDelete'];
    public function getBookingramzaan()
    {
        return Bookingenquiry::query()
        ->where('cat_id', 3)
        ->searchLike('cust_name', $this->search_name)
        ->desc()
        ->paginate($this->perPage);

    } 
    public function filterBookingramzaan()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 

    public function toggleStatus(Bookingenquiry $bookingramzaan)
    {
        // dd($enquirie);
        $this->typesId = $bookingramzaan->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        

        $adminData = Bookingenquiry::whereId($this->typesId);
        // dd($faqData);
        $adminData->update(['is_active' => !$adminData->first()->is_active]);
        $this->alert('success', Lang::get('messages.bookingramzaan_status_changed', [
            'timer' => 5000,
        ]));
    }

    public function isDelete(Bookingenquiry $bookingramzaan)
    {
        // dd($enquirie);
        $this->typesId = $bookingramzaan->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $bookingData = Bookingenquiry::whereId($this->typesId);
        $bookingData->delete();
        $this->alert('success', Lang::get('messages.ramzaan_deleted', [
            'timer' => 5000,
        ]));
    }

    public function render()
    {
        return view('admin.manage-enquiry.booking-ramzaan.booking-ramzaanj-list-component', [
            'Bookingramzaan' => $this->getBookingramzaan()
        ]);
    }
}
