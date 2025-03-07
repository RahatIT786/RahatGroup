<?php

namespace App\Http\Controllers\Admin\TourManagement\IntDestination;

use Livewire\Component;
use App\Models\TourState;
use App\Models\IntTourDestination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class IntDestinationListComponent extends Component
{   
    use WithPagination, LivewireAlert;
    public $perPage = 10, $modalData, $packageTypeId, $Id, $is_edit,  $status,$tourpackageId ,$search_name;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getDestination()
    {
        return IntTourDestination::query()
            ->searchLike('name', $this->search_name)
            ->desc()->paginate($this->perPage);
    }

    public function isDelete(IntTourDestination $destination)
    {
        $this->tourpackageId = $destination->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $packagetypeData = IntTourDestination::whereId($this->tourpackageId);
        $packagetypeData->delete();
        $this->alert('success', Lang::get('messages.tour_delete'));
    }
    public function render()
    {
        return view('admin.tour-management.int-destination.int-destination-list-component', [
            'destinations' => $this->getDestination(),
        ]);
    }

  
}
