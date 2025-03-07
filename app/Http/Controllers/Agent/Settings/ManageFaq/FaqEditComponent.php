<?php

namespace App\Http\Controllers\Agent\Settings\ManageFaq;

use App\Models\Agent\Faq;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FaqEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $title,$question,$setting,$answer, $manageFaqId;
    public function mount(Faq $manageFaq)
    {
        // dd($manageFaq);
        $this->manageFaqId = $manageFaq->id;
        $this->title = $manageFaq->title;
        $this->question = $manageFaq->question;
        $this->answer = $manageFaq->answer;
        $this->status = $manageFaq->is_active;
        
    }  
    public function update()
    {
        $validated = $this->validate([
            'title' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ]);
        Faq::whereId($this->manageFaqId)->update($validated);
        $this->alert('success', Lang::get('messages.faq_update'));
        return to_route('agent.faq.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-faq.faq-edit-component');
    }
}
