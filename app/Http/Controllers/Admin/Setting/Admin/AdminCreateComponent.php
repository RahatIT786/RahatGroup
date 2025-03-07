<?php

namespace App\Http\Controllers\Admin\Setting\Admin;

use App\Models\Admin;
use App\Models\AdminType;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AdminCreateComponent extends Component
{
    public $name, $admin_id, $email, $password, $admin_type, $admintype, $Id;
    use LivewireAlert;
    public function save()
    {
        // dd($this->country_id);
        $validated = $this->validate([
            'name' => 'required',
            'admin_id' => 'required',
            'email' => 'required|email|min:3|unique:aihut_admin,email,' . $this->Id,
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'admin_type' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        // dd($validated);
        Admin::create($validated);
        $this->alert('success', Lang::get('messages.admin_save'));
        return to_route('admin.admin.index');
    }
    public function mount()
    {
        $this->admintype = AdminType::pluck('admin_type', 'id');
    }
    public function render()
    {
        return view('admin.setting.admin.admin-create-component');
    }
}
