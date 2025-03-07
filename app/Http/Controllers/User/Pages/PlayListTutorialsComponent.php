<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class PlayListTutorialsComponent extends Component
{

    public function getPlayList()
    {
        // dd('hi');
        // dd(Content::where('page_id', 9)->first());
        $agent =  Content::where('page_id', 3)->with('pagecontent')->first();
        return $agent;
        // dd($agent);
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.play-list-tutorials-component', [
            'QsPlay' => $this->getPlayList()
        ]);
    }
}
