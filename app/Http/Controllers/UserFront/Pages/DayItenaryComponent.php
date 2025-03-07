<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class DayItenaryComponent extends Component
{

    public function getDayItenary()
    {
        $agent =  Content::where('page_id', 9)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.day-itenary-component', [
            'dayItenary' => $this->getDayItenary()
        ]);
    }
}
