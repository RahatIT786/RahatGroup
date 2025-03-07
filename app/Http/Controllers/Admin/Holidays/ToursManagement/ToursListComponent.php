<?php

namespace App\Http\Controllers\Admin\Holidays\ToursManagement;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use App\Models\HolidayTour;
use App\Models\TourDestination;
use App\Helpers\Helper;

class ToursListComponent extends Component
{   
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public $destinations,$holidayTourId,$holidayTourDlt;
    public $tourType,$perPage = 10;

    public function mount()
    {
        // $this->tourType = Helper::tourType();
        $this->destinations = TourDestination::all();
    }

    public function getTours()
    {
       
        $Tours = HolidayTour::desc()->with('state','tourImages')
                    // ->searchLike('name', $this->package_name)
                    ->paginate($this->perPage);
                    
        return $Tours;

        // $Tours =  HolidayTour::desc()->with('state','tourImages')
        // ->destination()->get();
        //  dd($Tours);
    }

    public function toggleStatus(HolidayTour $holidayTour)
    {
        $this->holidayTourId = $holidayTour->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $holidayTourMasterData = HolidayTour::whereId($this->holidayTourId);
        $holidayTourMasterData->update(['is_active' => !$holidayTourMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.tour_status_changed'));
    }

    public function isDelete(HolidayTour $holidayTour)
    {
        $this->holidayTourDlt = $holidayTour->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $tourData = HolidayTour::whereId($this->holidayTourDlt);
        $tourData->delete();
        $this->alert('success', Lang::get('messages.tour_deleted'));
    }

    public function render()
    {
        return view('admin.holidays.tours-management.tours-list-component', [
            'tours' => $this->getTours()
        ]);
       
    }
}
