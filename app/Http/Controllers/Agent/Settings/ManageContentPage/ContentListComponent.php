<?php

namespace App\Http\Controllers\Agent\Settings\ManageContentPage;

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
    public $perPage = 10,$page_name,$typesId,$manageContentId=null,$content_modal_data;
    protected $listeners = ['confirmed','confirmDelete'];

    public function getuserContents()
    {
        return Content::query()
        ->where('user_id', auth()->user()->id)
        ->desc()
        ->with('pagecontent')
        ->searchPageContent($this->page_name)
        ->paginate($this->perPage);
    }

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
        $this->content_modal_data= $content;
    }

    public function filterContent()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 


    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-content-page.content-list-component', [
            'userContent' => $this->getuserContents()
        ]);
    }
}
