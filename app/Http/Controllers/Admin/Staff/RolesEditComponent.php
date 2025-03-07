<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Roles;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RolesEditComponent extends Component
{
    public $id, $staff_role, $status;
    use LivewireAlert;

    public function mount(Roles $roles)
    {
        $this->id = $roles->id;
        $this->staff_role = $roles->staff_role;
        $this->status = $roles->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'staff_role' => 'required',
        ]);
        $validated['is_active'] = $this->status;
        Roles::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.roles_update'));
        return to_route('admin.roles.index');
    }

    public function render()
    {
        return view('admin.staff.roles-edit-component');
    }
}
