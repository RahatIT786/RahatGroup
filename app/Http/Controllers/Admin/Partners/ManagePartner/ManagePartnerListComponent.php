<?php

namespace App\Http\Controllers\Admin\Partners\ManagePartner;

use Livewire\Component;
use App\Models\Partner;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Helpers\Helper;


class ManagePartnerListComponent extends Component
{
    use WithPagination, LivewireAlert;

    public $perPage = 10,$Id,$name;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getmanagePartner()
    {
        return Partner::query()
        ->searchLike('name', $this->name)
        ->desc()
        ->paginate($this->perPage);

    }
    public function filterPartner()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function isDelete(Partner $partner)
    {
        $this->Id = $partner->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $partnerData = Partner::whereId($this->Id);
        $partnerData->delete();
        $this->alert('success', Lang::get('messages.partner_delete'));
    }

    public function render()
    {
        return view('admin.partners.manage-partner.manage-partner-list-component', [
            'partners' => $this->getmanagePartner()
        ]);
    }
}
