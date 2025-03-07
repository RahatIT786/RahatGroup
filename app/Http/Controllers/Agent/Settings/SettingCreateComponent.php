<?php

namespace App\Http\Controllers\Agent\Settings;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SettingCreateComponent extends Component
{
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.setting-create-component');
    }
}
