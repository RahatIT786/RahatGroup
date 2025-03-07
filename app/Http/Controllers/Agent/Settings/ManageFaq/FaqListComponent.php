<?php

namespace App\Http\Controllers\Agent\Settings\ManageFaq;

use App\Models\Agent\Faq;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FaqListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$typesId,$search_title,$manageFaqId=null,$faq_modal_data,$faq_modal_datas,$manageFaq;
    protected $listeners = ['confirmed','confirmDelete'];
    public function getmanageFaq()
    {
        // dd(auth()->user('agents')->id);
        return Faq::query()
        ->where('agent_id', auth()->user('agents')->id)
            ->desc()
            ->searchLike('title', $this->search_title)
            ->paginate($this->perPage);
    }
    public function toggleStatus(Faq $manageFaq)
    {
        // dd($manageFaq);
        $this->manageFaqId = $manageFaq->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->manageFaqId);

        $faqData = Faq::whereId($this->manageFaqId);
        // dd($faqData);
        $faqData->update(['is_active' => !$faqData->first()->is_active]);
        $this->alert('success', Lang::get('messages.faq_status_changed'));
    }

    public function isDelete(Faq $faq)
    {
        // dd($faq);
        $this->typesId = $faq->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $faqData = Faq::whereId($this->typesId);
        $faqData->delete();
        $this->alert('success', Lang::get('messages.faq_delete'));
    }
    public function filterFaq()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }    
    public function getFaq(Faq $faq)
    {
        $this->faq_modal_data = $faq;
    }

    public function getAnswer(Faq $faq)
    {
        $this->faq_modal_datas = $faq;
    }
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-faq.faq-list-component', [
            'manageFaqs' => $this->getmanageFaq()
        ]);

    }
}
