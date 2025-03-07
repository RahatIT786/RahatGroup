<?php

namespace App\Http\Controllers\Admin\Setting\SiteSetting;

use App\Models\Setting;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SiteSettingsListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_parameter, $status, $id, $is_edit, $parameter_name;
    public function getSiteSetting()
    {
        return Setting::query()
            ->searchLike('parameter_name', $this->search_parameter)
            ->desc()
            ->paginate($this->perPage);
    }
    public function edit(Setting $settings)
    {
        // dd($settings);
        $this->is_edit = true;
        $this->id = $settings->id;
        $this->parameter_name = $settings->parameter_name;
        $this->status = $settings->is_active;
    }
    public function update()
    {
        $validated = $this->validate([
            'parameter_name' => 'required',
        ]);
        $validated['is_active'] = $this->status;
        Setting::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.site_fee_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
    }
    public function filterSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function render()
    {
        return view('admin.setting.site-setting.site-settings-list-component', [
            'SiteSettings' => $this->getSiteSetting()
        ]);
    }
}
