<?php

namespace App\Http\Controllers\Admin\Setting;

use Livewire\Component;

class SiteSettingsListComponent extends Component
{
    public $is_edit;
    
    public function edit()
    {
        $this->is_edit = true;
    }
    public function render()
    {
        return view('admin.setting.site-settings-list-component');
    }
}
