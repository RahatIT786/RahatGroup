<?php

namespace App\Http\Controllers\Admin\Resources\Ration\RationViewDetail;

use App\Models\Ration;
use App\Models\RationDetails;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class RationViewDetailListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $flightMaster = null, $rationViewId, $modalData = null, $search_flight, $search_flight_code, $Id, $id, $main_item;
    protected $listeners = ['confirmed', 'confirmDelete'];
    
    public function mount(Ration $ration)
    {
        $this->id = $ration->id;
    }
    public function getRationViewData()
    {
        return RationDetails::query()
                    ->desc()
                    ->where('ration_id', $this->id)
                    ->searchLike('main_item', $this->main_item)
                    ->paginate($this->perPage);
    }

    public function toggleStatus(RationDetails $rationdetails)
    {
        $this->rationViewId = $rationdetails->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $rationViewData = RationDetails::whereId($this->rationViewId);
        $rationViewData->update(['is_active' => !$rationViewData->first()->is_active]);
        $this->alert('success', 'Status changed successfully');
    }
    
    public function isDelete(RationDetails $rationdetails)
    {
        $this->Id = $rationdetails->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $rationviewData = RationDetails::whereId($this->Id);
        $rationviewData->delete();
        $this->alert('success', 'Deleted successfully');
    }

    public function filterRation()
    {
        $this->resetPage();
    }


    public function render()
    {
        // dd($this->getRationViewData());
        return view('admin.resources.ration.ration-view-detail.ration-view-detail-list-component', [
            'rationViewData' => $this->getRationViewData(),
        ]);
    }
}
