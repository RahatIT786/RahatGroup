<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class ImportantNotesComponent extends Component
{

    public function getImportantNotes()
    {
        $agent =  Content::where('page_id', 11)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.important-notes-component', [
            'importantNotes' => $this->getImportantNotes()
        ]);
    }
}
