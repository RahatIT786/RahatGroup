<?php

namespace App\Http\Controllers\Admin\Holidays\ToursManagement;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

use App\Models\IntHolidayTour;
use App\Models\IntTourDestination;
use App\Helpers\Helper;

class IntToursListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public $destinations,$holidayTourId,$holidayTourDlt;
    public $tourType,$perPage = 10;

    public function mount()
    {
        // $this->tourType = Helper::tourType();
        $this->destinations = IntTourDestination::all();
    }
    public function getTours()
    {
       
        $Tours = IntHolidayTour::desc()->with('country','tourImages')
                    // ->searchLike('name', $this->package_name)
                    ->paginate($this->perPage);
                  
        return $Tours;
    }

    public function toggleStatus(IntHolidayTour $holidayTour)
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
        $holidayTourMasterData = IntHolidayTour::whereId($this->holidayTourId);
        $holidayTourMasterData->update(['is_active' => !$holidayTourMasterData->first()->is_active]);
        $this->alert('success', Lang::get('messages.tour_status_changed'));
    }

    public function isDelete(IntHolidayTour $holidayTour)
    {
        $this->holidayTourDlt = $holidayTour->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function render()
    {
        return view('admin.holidays.tours-management.int-tours-list-component', [
            'tours' => $this->getTours()
        ]);
    }
}
