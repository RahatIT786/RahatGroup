<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBroucher;

use App\Models\Boucher;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BroucherListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$typesId,$brochure_content;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getmanageBroucher()
    {
        return Boucher::query()
        ->searchLike('brochure_content', $this->brochure_content)
        ->desc()
        ->paginate($this->perPage);

    } 
    public function filterBrochure()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 


    public function toggleStatus(Boucher $boucher)
    {
        // dd($enquirie);
        $this->typesId = $boucher->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        

        $agentData = Boucher::whereId($this->typesId);
        // dd($faqData);
        $agentData->update(['is_active' => !$agentData->first()->is_active]);
        $this->alert('success', Lang::get('messages.broucher_status_changed'));
    }





    public function isDelete(Boucher $boucher)
    {
        // dd($enquirie);
        $this->typesId = $boucher->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Boucher::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.broucher_deleted'));
    }



    public function render()
    {
        return view('admin.manage-site-settings.manage-broucher.broucher-list-component', [
            'Broucher' => $this->getmanageBroucher()
        ]);
    }
}
