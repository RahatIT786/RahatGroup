<?php

namespace App\Http\Controllers\Agent\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

class FaqCreateComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.faq-create-component');
    }
}
