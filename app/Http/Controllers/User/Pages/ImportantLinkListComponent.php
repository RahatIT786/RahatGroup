<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;

class ImportantLinkListComponent extends Component
{

    public function getImportantLinks()
    {
        $link =  Content::where('page_id', 6)->with('pagecontent')->first();
        // dd($director);
        return $link;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.important-link-list-component', [
            'links' => $this->getImportantLinks()
        ]);
    }
}
