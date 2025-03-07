<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm;

use App\Models\Agm;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AgmListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$search_name,$typesId,$search_status;
    protected $listeners = ['confirmDelete','confirmed'];


    public function getAgm()
    {
        return Agm::query()
        ->searchLike('name', $this->search_name)
        ->searchStatus('is_active', $this->search_status)
        ->desc()
        ->paginate($this->perPage);
    } 

    public function filterAgm()
    {
        $this->resetPage(); 
    }  

    public function isDelete(Agm $agm)
    {
        // dd($agm);
        $this->typesId = $agm->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $agm = Agm::whereId($this->typesId);
        $agm->delete();
        $this->alert('success', Lang::get('messages.Agm_deleted', [
            'timer' => 5000,
        ]));     
    }

    public function toggleStatus(Agm $agm)
    {
        $this->typesId = $agm->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {      
        $agmData = Agm::whereId($this->typesId);
        $agmData->update(['is_active' => !$agmData->first()->is_active]);
        $this->alert('success', Lang::get('messages.agm_status_changed'));
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-agm.agm-list-component', [
            'agm' => $this->getAgm()
        ]);
    }
}
