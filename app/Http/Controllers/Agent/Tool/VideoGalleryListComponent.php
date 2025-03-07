<?php

namespace App\Http\Controllers\Agent\Tool;

use Livewire\Component;
use Livewire\Features\SupportPageComponents\BaseLayout;

class VideoGalleryListComponent extends Component
{
    #[BaseLayout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.video-gallery-list-component');
    }
}
