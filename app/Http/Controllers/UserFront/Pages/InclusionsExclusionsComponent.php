<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class InclusionsExclusionsComponent extends Component
{

    public function getInclusions()
    {
        $agent =  Content::where('page_id', 10)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.inclusions-exclusions-component', [
            'inclusions' => $this->getInclusions()
        ]);
    }
}
