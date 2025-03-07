<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageRequestQuote;

use App\Models\Bookingenquiry;
use App\Models\PackageMaster;
use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RequestQuoteListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $typesId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getrequestquote()
    {
        return Bookingenquiry::query()
            ->with('packagemaster')
            ->desc()
            ->paginate($this->perPage);
    }
    public function filterEnquirie()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }


    public function toggleStatus(Bookingenquiry $enquirie)
    {
        // dd($enquirie);
        $this->typesId = $enquirie->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {


        $agentData = Bookingenquiry::whereId($this->typesId);
        // dd($faqData);
        $agentData->update(['status' => !$agentData->first()->status]);
        $this->alert('success', Lang::get('messages.request_quote_status_changed'));
    }





    public function isDelete(Bookingenquiry $enquirie)
    {
        // dd($enquirie);
        $this->typesId = $enquirie->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Bookingenquiry::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.request_quote__delete'));
    }


    public function render()
    {
        return view('admin.manage-site-settings.manage-request-quote.request-quote-list-component', [
            'Requestquote' => $this->getrequestquote()
        ]);
    }
}
