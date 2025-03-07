<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;

class GuidesListComponent extends Component
{
    public function getGuide()
    {
        $guide =  Content::where('page_id', 7)->with('pagecontent')->first();
        return $guide;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.guides-list-component', [
            'guides' => $this->getGuide()
        ]);
    }
}
