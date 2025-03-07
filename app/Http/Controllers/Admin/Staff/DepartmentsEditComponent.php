<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Department;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DepartmentsEditComponent extends Component
{
    public $id, $department_name, $status;
    use LivewireAlert;

    public function mount(Department $departments)
    {
        $this->id = $departments->id;
        $this->department_name = $departments->department_name;
        $this->status = $departments->is_active;
    }

    public function update()
    {
        $validated = $this->validate([
            'department_name' => 'required',
        ]);
        $validated['is_active'] = $this->status;
        Department::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.department_update'));
        return to_route('admin.department.index');
    }

    public function render()
    {
        return view('admin.staff.departments-edit-component');
    }
}
