<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class PlayListComponent extends Component
{

    public function getPlayList()
    {
        // dd('hi');
        // dd(Content::where('page_id', 9)->first());
        $agent =  Content::where('page_id', 3)->with('pagecontent')->first();
        return $agent;
        // dd($agent);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.play-list-component', [
            'QsPlay' => $this->getPlayList()
        ]);
    }
}
