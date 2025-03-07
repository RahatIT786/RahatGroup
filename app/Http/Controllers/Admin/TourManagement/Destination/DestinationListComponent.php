<?php

namespace App\Http\Controllers\Admin\TourManagement\Destination;

use Livewire\Component;
use App\Models\TourState;
use App\Models\TourDestination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class DestinationListComponent extends Component
{

    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $packageTypeId, $Id, $is_edit,  $status,$tourpackageId ,$search_name;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getTourPackages()
    {
        return TourDestination::query()
            ->searchLike('name', $this->search_name)
            ->desc()->paginate($this->perPage);
    }

    public function filterTourPackage()
    {
        $this->resetPage();
    }

    public function getModalContent(TourDestination $tourpackage)
    {
        $this->modalData = $tourpackage;
    }


    public function isDelete(TourDestination $tourpackage)
    {
        $this->tourpackageId = $tourpackage->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $packagetypeData = TourDestination::whereId($this->tourpackageId);
        $packagetypeData->delete();
        $this->alert('success', Lang::get('messages.tour_delete'));
    }





    public function render()
    {
        return view('admin.tour-management.destination.destination-list-component', [
            'tourpackages' => $this->getTourPackages(),
        ]);
    }
}
