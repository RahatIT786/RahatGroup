<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage;

use App\Models\Agent\PageContent;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContentEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $page_id,$description,$page_name,$pagecontent,$manageContentId;
   
    public function mount(Content $content)
    {
        // dd($manageSetting);
        $this->manageContentId = $content->id;
        $this->page_id = $content->page_id;
        $this->description = $content->description;
        $this->status = $content->is_active;
        $this->pagecontent = PageContent::pluck('page_name', 'id');
    }
    public function update()
    {
        $validated = $this->validate([
            'page_id' => 'required',
            'description' => 'required',
        ], [], [
            'page_id' => 'page name',
            'description' => 'page content',
        ]);
        Content::whereId($this->manageContentId)->update($validated);
        $this->alert('success', Lang::get('messages.content_update', [
            'timer' => 7000,
        ]));
        return to_route('admin.content.index');
    }
    public function render()
    {
        return view('admin.manage-site-settings.manage-content-page.content-edit-component');
    }
}
