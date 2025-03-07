<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class ImportantLinksComponent extends Component
{
    public function getImportantLinks()
    {
        $link =  Content::where('page_id', 6)->with('pagecontent')->first();
        // dd($director);
        return $link;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.important-links-component', [
            'links' => $this->getImportantLinks()
        ]);
    }
}
