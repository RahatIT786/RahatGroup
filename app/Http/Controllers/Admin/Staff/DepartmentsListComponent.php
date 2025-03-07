<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Department;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentsListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 5;

    public function getDepartment()
    {
        return Department::query()

            ->desc()->paginate($this->perPage);
    }
    public function render()
    {
        return view('admin.staff.departments-list-component', [
            'departments' => $this->getDepartment(),
        ]);
    }
}
