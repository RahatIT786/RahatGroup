<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class GuidesComponent extends Component
{

    public function getGuide()
    {
        $guide =  Content::where('page_id', 7)->with('pagecontent')->first();
        return $guide;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.guides-component', [
            'guides' => $this->getGuide()
        ]);
    }
}
