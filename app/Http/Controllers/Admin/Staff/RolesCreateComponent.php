<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Roles;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RolesCreateComponent extends Component
{
    public $staff_role;
    use LivewireAlert;

    public function save()
    {
        $validated = $this->validate([
            'staff_role' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        // dd($validated);
        Roles::create($validated);
        $this->alert('success', Lang::get('messages.roles_create'));
        return to_route('admin.roles.index');
    }

    public function render()
    {
        return view('admin.staff.roles-create-component');
    }
}
