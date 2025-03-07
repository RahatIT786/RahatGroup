<?php

namespace App\Http\Controllers\Agent\Tool;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ImageGalleryListComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.image-gallery-list-component');
    }
}
