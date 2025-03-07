<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAward;
use App\Models\Award;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class AwardListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 5,$typesId,$title;
    protected $listeners = ['confirmed','confirmDelete'];

    public function getAward()
    {
        return Award::query()
      
            ->desc()
            ->searchLike('title', $this->title)
            ->paginate($this->perPage);
    }


    public function toggleStatus(Award $award)
    {
        // dd($enquirie);
        $this->typesId = $award->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        

        $Data = Award::whereId($this->typesId);

        $Data->update(['is_active' => !$Data->first()->is_active]);
        $this->alert('success', Lang::get('messages.award_status_changed'));
    }


    public function isDelete(Award $award)
    {
        
        $this->typesId = $award->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Award::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.award_deleted', [
            'timer' => 5000,
        ]));
       
    }
    public function filterAward()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 

    


    public function render()
    {
        return view('admin.manage-site-settings.manage-award.award-list-component', [
            'Award' => $this->getAward()
        ]);
    }
}
