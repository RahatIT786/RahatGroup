<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageFaq;

use App\Models\Agent\Faq;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FaqCreateComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$title,$question,$answer,$status;
    public function save()
    {
        $validated = $this->validate([
            'title' => 'required',
            'question' => 'required',
            'answer' => 'required',
        ], [], [
            'title' => 'title',
            'question' => 'question',
            'answer' => 'answer',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        Faq::create([

            'title' => $this->title,
            'question' => $this->question,
            'answer' => $this->answer,
            'is_active' => $this->status ?? 1,

        ]);
        $this->alert('success', 'Successfully Added');
        return redirect()->route('admin.faq.index');

    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-faq.faq-create-component');
    }
}
