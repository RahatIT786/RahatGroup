<?php

namespace App\Http\Controllers\Agent\Settings\ManageSettings;

use App\Models\Agent\ManageSetting;
use App\Models\Agent\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class SettingEditComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $parameter_id,$settings_value,$setting,$parameter_name, $manageSettingsId,$id;
    public $editMode = false;

   
    public function mount(ManageSetting $manageSetting)
    {
        // dd($manageSetting);
        $this->manageSettingsId = $manageSetting->id;
        $this->parameter_id = $manageSetting->parameter_id;
        $this->settings_value = $manageSetting->settings_value;
        $this->status = $manageSetting->is_active;
        $this->setting = Setting::pluck('parameter_name', 'id');
    }

    public function update()
    {
        $validated = $this->validate([
            'parameter_id' => 'required',
            'settings_value' => 'required',
        ], [], [
            'parameter_id' => 'parameter name',
            
        ]);
        ManageSetting::whereId($this->manageSettingsId)->update($validated);
        $this->alert('success', Lang::get('messages.setting_update', [
            'timer' => 5000,
        ]));
        return to_route('agent.setting.index');
    }


    #[Layout('agent.layouts.app')]



    public function render()
    {
        return view('agent.settings.manage-settings.setting-edit-component');
    }
}
