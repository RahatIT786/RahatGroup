<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageFaq;

use App\Models\Agent\Faq;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FaqEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $title,$question,$setting,$answer,$status, $manageFaqId;
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
        if($this->answer == '<p><br></p>'){
            $this->answer = '';
        }
        // dd($this->answer);
        $validated=$this->validate([
            'title' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ], [], [
            'title' => 'title',
            'question' => 'question',
            'answer' => 'answer',
        ]);

            Faq::whereId($this->manageFaqId)->update($validated);
            $this->alert('success', Lang::get('messages.content_update', [
                'timer' => 7000,
            ]));

        return to_route('admin.faq.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-faq.faq-edit-component');
    }
}
