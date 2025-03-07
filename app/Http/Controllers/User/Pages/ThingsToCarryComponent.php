<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class ThingsToCarryComponent extends Component
{
    public function getThingsToCarry()
    {
        $agent =  Content::where('page_id', 14)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.things-to-carry-component', [
            'thingsToCarry' => $this->getThingsToCarry()
        ]);
    }
}
