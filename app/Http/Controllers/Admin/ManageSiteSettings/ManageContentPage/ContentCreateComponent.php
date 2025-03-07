<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage;

use App\Models\Agent\PageContent;
use App\Models\Agent\Content;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContentCreateComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $usedPageIds;
    public $perPage = 10, $page_id, $description, $page_name, $pagecontent, $page_content;
    
    public function save()
    {
        // dd($this->page_id, $this->description);
        $validated = $this->validate([
            'page_id' => 'required',
            'description' => 'required',
        ], [], [
            'page_id' => 'page name',
            'description' => 'page content',
        ]);
        // dd($validated);
        $visaDataDetails = Content::create([
            'page_id' => $validated['page_id'],
            'description' => $validated['description'],
           
        ]);
        // dd($visaDataDetails);
        $this->alert('success', Lang::get('messages.content_save', [
            'timer' => 5000,
        ]));
        return redirect()->route('admin.content.index');
    
    }

    public function mount()
    {
        $this->usedPageIds = Content::pluck('page_id')->toArray();
        $this->pagecontent = PageContent::whereNotIn('id', $this->usedPageIds)->pluck('page_name', 'id');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-content-page.content-create-component');
    }
}