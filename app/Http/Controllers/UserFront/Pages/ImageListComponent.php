<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use App\Models\GalleryImage;
use Livewire\Attributes\Layout;

class ImageListComponent extends Component
{
    public $images;

    public function mount()
    {
        $this->images = GalleryImage::active()->desc()->get();
        // dd($this->images);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.image-list-component', [
            'images' => $this->images
        ]);
    }
}
