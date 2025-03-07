<?php

namespace App\Http\Controllers\Agent\Settings\ManageSettings;

use App\Models\Agent\ManageSetting;
use App\Models\Agent\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;

class SettingCreateComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$parameter_name,$parameter_id,$setting,$settings_value;

    public function save()
    {
        // dd(auth()->user()->id);
       
        $validated = $this->validate([
            'parameter_id' => 'required',
            'settings_value' => 'required',
        ],[],[
            'parameter_id' => 'parameter name',
            
            
        ]);
        // dd(auth()->user()->id);
        $validated['user_id'] = auth()->user()->id;
        $visaDataDetails = ManageSetting::create([
           
            'parameter_id' => $validated['parameter_id'],
            'settings_value' => $validated['settings_value'],
            'user_id' => $validated['user_id'],
            
           
        ]);

        $this->alert('success', Lang::get('messages.setting_save', [
            'timer' => 5000,
        ]));
        return redirect()->route('agent.setting.index');
    
    }
    
    public function mount()

    {
        $usedPageIds = ManageSetting::where('user_id',auth()->user()->id)->pluck('parameter_id')->toArray();
        $this->setting = Setting::whereNotIn('id', $usedPageIds)->pluck('parameter_name', 'id');
    }
   

 
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-settings.setting-create-component');
    }
}
