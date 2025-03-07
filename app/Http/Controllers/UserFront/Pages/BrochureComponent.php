<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Boucher;

class BrochureComponent extends Component
{
    public $brochures;

    public function mount()
    {
        $this->brochures = Boucher::active()->orderBy('created_at', 'desc')->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.brochure-component', ['brochures' => $this->brochures]);
    }
}
