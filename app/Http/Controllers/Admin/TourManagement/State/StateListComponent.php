<?php

namespace App\Http\Controllers\Admin\TourManagement\State;

use Livewire\Component;
use App\Models\TourState;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StateListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $packageTypeId, $Id, $tourstateId ,$search_name,$typesId,$tourpackage;
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];

    public function getStatePackages()
    {
        $abc = TourState::get();

        foreach($abc as $state){
            $slug =  Str::slug($state->name);
            $state->update([
                'slug' => $slug,
            ]);
        }
          
        return TourState::query()
            ->searchLike('name', $this->search_name)
            ->desc()->paginate($this->perPage);
    }

    public function filterTourPackage()
    {
        $this->resetPage();
    }


    public function toggleStatus(TourState $tourstate)
    {
        // dd($enquirie);
        $this->typesId = $tourstate->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {


        $agentData = TourState::whereId($this->typesId);
        // dd($faqData);
        $agentData->update(['is_active' => !$agentData->first()->is_active]);
        $this->alert('success', Lang::get('messages.state_status_changed'));
    }




    public function isDelete(TourState $tourstate)
    {
        $this->tourstateId = $tourstate->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $packagetypeData = TourState::whereId($this->tourstateId);
        $packagetypeData->delete();
        $this->alert('success', Lang::get('messages.state_delete'));
    }


    public function render()
    {
        return view('admin.tour-management.state.state-list-component', [
            'tourstates' => $this->getStatePackages(),
        ]);
    }
}
