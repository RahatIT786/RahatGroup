<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Roles;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class RolesListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 5;

    public function getRoles()
    {
        return Roles::query()

            ->desc()->paginate($this->perPage);
    }
    public function render()
    {
        return view('admin.staff.roles-list-component', [
            'roles' => $this->getRoles(),
        ]);
    }
}
