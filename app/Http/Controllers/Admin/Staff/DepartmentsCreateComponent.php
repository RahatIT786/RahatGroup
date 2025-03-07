<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Department;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DepartmentsCreateComponent extends Component
{
    public $department_name;
    use LivewireAlert;

    public function save()
    {
        $validated = $this->validate([
            'department_name' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        // dd($validated);
        Department::create($validated);
        $this->alert('success', Lang::get('messages.department_create'));
        return to_route('admin.department.index');
    }

    public function render()
    {
        return view('admin.staff.departments-create-component');
    }
}
