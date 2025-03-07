<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageContentPage;

use App\Models\Agent\PageContent;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ContentListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $page_name, $typesId, $manageContentId = null, $content_modal_data;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getuserContents()
    {
        return Content::query()

            ->desc()
            ->whereNull('user_id')
            ->with('pagecontent')
            ->searchPageContent($this->page_name)
            ->paginate($this->perPage);
    }


    // public function toggleStatus(Content $content)
    // {

    //     $this->manageContentId = $content->id;
    //     $this->confirm('Are you sure to change status?', [
    //         'icon' => 'question',
    //         'confirmButtonText' => 'Yes',
    //         'onConfirmed' => 'confirmed',
    //     ]);
    // }
    // public function confirmed()
    // {


    //     $contentData = Content::whereId($this->manageContentId);
    //     // dd($contentData);
    //     $contentData->update(['is_active' => !$contentData->first()->is_active]);
    //     $this->alert('success', Lang::get('messages.Content_status_changed', [
    //         'timer' => 5000,
    //     ]));

    // }


    public function isDelete(Content $content)
    {
        // dd($content);
        $this->typesId = $content->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = Content::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.Content_deleted', [
            'timer' => 5000,
        ]));
    }
    public function getContent(Content $content)
    {
        $this->content_modal_data = $content;
    }

    public function filterContent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }


    public function render()
    {
        return view('admin.manage-site-settings.manage-content-page.content-list-component', [
            'userContent' => $this->getuserContents()
        ]);
    }
}
