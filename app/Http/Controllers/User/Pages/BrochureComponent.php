<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\Boucher;
use Livewire\Component;
use Livewire\Attributes\Layout;

class BrochureComponent extends Component
{
    public $brochures;

    public function mount()
    {
        $this->brochures = Boucher::active()->orderBy('created_at', 'desc')->get();
    }
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.brochure-component', ['brochures' => $this->brochures]);
    }
}