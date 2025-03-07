<?php

namespace App\Http\Controllers\Agent\Settings\ManageSettings;

use App\Models\Agent\ManageSetting;
use App\Models\Agent\Setting;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class SettingListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$parameter_name,$typesId,$manageSetings=null,$setting_value;
    protected $listeners = ['confirmDelete'];
    public function getmanageSetting()
    {
        return ManageSetting::query()
        ->where('user_id', auth()->user('agents')->id)
           
            ->with('setting')
            ->searchSetting($this->parameter_name)
            ->searchLike('settings_value', $this->setting_value)
            ->desc()
            ->paginate($this->perPage);
    }
    public function isDelete(ManageSetting $manageSetting)
    {
        // dd($manageSetting);
        $this->typesId = $manageSetting->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $hotelData = ManageSetting::whereId($this->typesId);
        $hotelData->delete();
        $this->alert('success', Lang::get('messages.setting_deleted'));
    }


    public function filterManageSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    } 
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.manage-settings.setting-list-component', [
            'manageSettings' => $this->getmanageSetting()
        ]);
    }
}
