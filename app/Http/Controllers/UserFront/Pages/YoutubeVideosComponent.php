<?php

namespace App\Http\Controllers\UserFront\Pages;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class YoutubeVideosComponent extends Component
{
    public function getYoutubeVideo()
    {
        $agent =  Content::where('page_id', 36)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.youtube-videos-component', [
            'youtubevideo' => $this->getYoutubeVideo()
        ]);
    }
}
