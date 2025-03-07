<?php

namespace App\Http\Controllers\Agent\Settings\ManageContentPage;

use App\Models\Agent\PageContent;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContentCreateComponent extends Component
{
    use WithPagination, LivewireAlert;
    
    public $perPage = 10, $page_id, $description, $page_name, $pagecontent, $page_content;

    public function save()
    {
        $validated = $this->validate([
            'page_id' => 'required',
            'description' => 'required',
        ], [], [
            'page_id' => 'page name',
            'description' => 'page content',
        ]);
        
        $validated['user_id'] = auth()->user()->id;
        
        $visaDataDetails = Content::create([
            'page_id' => $validated['page_id'],
            'description' => $validated['description'],
            'user_id' => $validated['user_id'],
        ]);

        $this->alert('success', Lang::get('messages.content_save', [
            'timer' => 5000,
        ]));
        
        return redirect()->route('agent.content.index');
    }

    public function mount()
    {
        
        // Fetch the IDs of pages that are already used
        $usedPageIds = Content::where('user_id',auth()->user()->id)->pluck('page_id')->toArray();
        
        // Exclude the used page IDs when fetching the page names
        $this->pagecontent = PageContent::whereNotIn('id', $usedPageIds)->whereIn('id',[28,29,30,31,32,33,34])->pluck('page_name', 'id');
       
    }
    
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-content-page.content-create-component');
    }
}
