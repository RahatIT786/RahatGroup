<?php

namespace App\Http\Controllers\Agent\Settings\ManageFaq;

use App\Models\Agent\Faq;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FaqCreateComponent extends Component
{
    use WithPagination, LivewireAlert;

    public $perPage = 10, $title, $question, $answer, $status;

    public function mount(Faq $faq)
    {
        $this->title = $faq->title;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->status = $faq->is_active;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'question' => 'required|string|max:1000', // Adjust max length as per your requirements
            'answer' => 'required|string|max:2000',   // Adjust max length as per your requirements
        ], [
            'title.required' => 'The title field is required.',
            'question.required' => 'The question field is required.',
            'question.max' => 'The question may not be greater than :max characters.',
            'answer.required' => 'The answer field is required.',
            'answer.max' => 'The answer may not be greater than :max characters.',
        ]);
        

        $validatedData['agent_id'] = auth()->user()->id;
        $validatedData['is_active'] = $this->status ?? 1;

        Faq::create([
            'title' => $validatedData['title'],
            'question' => $validatedData['question'],
            'answer' => $validatedData['answer'],
            'agent_id' => $validatedData['agent_id'],
            'is_active' => $validatedData['is_active'],
        ]);

        $this->alert('success', Lang::get('messages.faq_save'));
        return redirect()->route('agent.faq.index');
    }

    public function render()
    {
        return view('agent.settings.manage-faq.faq-create-component')->layout('agent.layouts.app');
    }
}
