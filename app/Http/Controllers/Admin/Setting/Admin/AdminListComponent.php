<?php

namespace App\Http\Controllers\Admin\Setting\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class AdminListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $search_admin_name, $search_email, $parameter_name, $parameter_value, $status, $id, $is_edit, $AdminId;
    public $adminId = null;
    public function getAdmin()
    {
        return Admin::query()
            ->searchLike('name', $this->search_admin_name)
            ->searchLike('email', $this->search_email)
            ->desc()
            ->paginate($this->perPage);
    }
    public function isDelete(Admin $admin)
    {
        $this->AdminId = $admin->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $adminData = Admin::whereId($this->AdminId);
        $adminData->delete();
        $this->alert('success', Lang::get('messages.admin_delete'));
    }
    public function toggleStatus(Admin $admin)
    {
        // dd($user);
        $this->adminId = $admin->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $adminData = Admin::whereId($this->adminId);
        $adminData->update(['is_active' => !$adminData->first()->is_active]);
        // $this->dispatch('user-list-updated');
        $this->alert('success', Lang::get('messages.admin_status_changed'));
    }
    public function filterAdmin()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function render()
    {
        return view('admin.setting.admin.admin-list-component', [
            'AdminList' => $this->getAdmin()
        ]);
    }
}
