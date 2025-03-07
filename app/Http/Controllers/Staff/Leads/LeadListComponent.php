<?php

namespace App\Http\Controllers\Staff\Leads;

use App\Models\Staff\Lead;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;


class LeadListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $search_name, $search_email, $search_phone, $search_status,$search_completed, $perPage = 5;
    public $modalData = null;
    public $userId = null;

    public function getLeads()
    {
        return Lead::query()
            ->searchLike('name', $this->search_name)
            ->searchLike('email', $this->search_email)
            ->searchLike('phone', $this->search_phone)
            ->searchStatus('is_active', $this->search_status)
            ->searchStatus('completed', $this->search_completed)
            ->desc()->paginate($this->perPage);
    }

    public function filterLeads()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.leads.lead-list-component',[
            'leads'=>$this->getLeads()
        ]);
    }
}
