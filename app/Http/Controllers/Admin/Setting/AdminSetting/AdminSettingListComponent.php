<?php

namespace App\Http\Controllers\Admin\Setting\AdminSetting;

use App\Models\AdminSetting;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AdminSettingListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_parameter, $search_value, $parameter_name, $parameter_value, $status, $id, $is_edit;
    public function getAdminSetting()
    {
        return AdminSetting::query()
            ->searchLike('parameter_name', $this->search_parameter)
            ->searchLike('parameter_value', $this->search_value)
            ->desc()
            ->paginate($this->perPage);
    }
    public function edit(AdminSetting $settings)
    {
        $this->resetValidation();
        $this->is_edit = true;
        $this->id = $settings->id;
        $this->parameter_name = $settings->parameter_name;
        $this->parameter_value = $settings->parameter_value;
        $this->status = $settings->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'parameter_name' => 'required',
            'parameter_value' => 'required',
        ]);
        $validated['is_active'] = $this->status;
        AdminSetting::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.admin_setting_update'));
        $this->dispatch('close-modal', modal: 'editModal');
        $this->is_edit = false;
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset(['parameter_name', 'parameter_value', 'status']);
        $this->resetPage();
    }

    public function filterSetting()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function render()
    {
        return view('admin.setting.admin-setting.admin-setting-list-component', [
            'AdminSettings' => $this->getAdminSetting()
        ]);
    }
}
