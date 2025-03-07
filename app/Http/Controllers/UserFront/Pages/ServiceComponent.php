<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Services;

class ServiceComponent extends Component
{
    public $service,$slug;

    public function mount($slug)
    {
        $this->slug=$slug;
        $this->service = Services::where('slug', $slug)->first();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.service-component');
    }
}

// public function getService()
//     {
//         return Services::active()->desc()->first();
//     }
