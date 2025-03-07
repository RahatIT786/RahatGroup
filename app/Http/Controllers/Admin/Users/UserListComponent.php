<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class UserListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    public $search_name, $search_email, $search_status, $search_role, $perPage = 5;

    public $modalData = null;
    public $userId = null;

    protected $listeners = ['confirmed', 'confirmDelete'];
    // protected $queryString = ['search_name', 'search_email', 'search_status', 'page'];


    public function getUsers()
    {
        // dd(User::find(1)->roles);
        return User::query()
            ->searchLike('name', $this->search_name)
            ->searchLike('email', $this->search_email)
            ->searchStatus('is_active', $this->search_status)
            // ->searchRole($this->search_role)
            // ->whereHas('roles')
            // ->with('roles')
            ->desc()->paginate($this->perPage);
    }

    // public function getRoles()
    // {
    //     return Role::get();
    // }

    public function filterUsers()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function getModalContent(User $user)
    {
        $this->modalData = $user;
    }

    public function toggleStatus(User $user)
    {
        // dd($user);
        $this->userId = $user->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $userData = User::whereId($this->userId);
        $userData->update(['is_active' => !$userData->first()->is_active]);
        // $this->dispatch('user-list-updated');
        $this->alert('success', Lang::get('messages.user_status_changed'));
    }

    public function isDelete(User $user)
    {
        // dd($user);
        $this->userId = $user->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $userData = User::whereId($this->userId);
        $userData->delete();
        $this->alert('success', Lang::get('messages.user_delete'));
    }

    public function render()
    {
        return view('admin.users.user-list-component', [
            'users' => $this->getUsers(),
            // 'roles' => $this->getRoles(),
        ]);
    }
    // public function render()
    // {
    //     return view('admin.users.user-list-component');
    // }
}
