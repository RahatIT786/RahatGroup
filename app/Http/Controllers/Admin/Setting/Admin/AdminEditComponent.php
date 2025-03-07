<?php

namespace App\Http\Controllers\Admin\Setting\Admin;

use App\Models\Admin;
use App\Models\AdminType;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class AdminEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $admintype, $is_edit, $id, $admin_type, $name, $admin_id, $email, $password, $Id;

    public function mount(Admin $admin)
    {
        // dd($admin);
        $this->admintype = AdminType::pluck('admin_type', 'id');
        $this->id = $admin->id;
        $this->Id = $admin->id;
        $this->admin_type = $admin->admin_type;
        $this->name = $admin->name;
        $this->admin_id = $admin->admin_id;
        $this->email = $admin->email;
        // $this->password = $admin->password;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => 'required',
            'admin_id' => 'required',
            'email' => 'required|email|min:3|unique:aihut_admin,email,' . $this->Id,
            // 'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'admin_type' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;

        $admin = Admin::find($this->id);
        $admin->update($validated);
        $this->alert('success', Lang::get('messages.admin_update'));
        return to_route('admin.admin.index');
    }
    public function render()
    {
        return view('admin.setting.admin.admin-edit-component');
    }
}
