<?php

namespace App\Http\Controllers\Agent\Tool;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VideoGalleryCreateComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.video-gallery-create-component');
    }
}
