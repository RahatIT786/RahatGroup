<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UserEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $isUploaded = false;
    public $id, $name, $email, $phone, $profile_image, $address, $status, $role_id, $admin_id;

    public function mount(Admin $admin)
    {
        // dd($user);
        $this->id = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->admin_id = $admin->admin_id;
        $this->phone = $admin->phone;
        $this->address = $admin->address;
        $this->status = $admin->is_active;
    }

    public function update()
    {
        try{
            $user = Admin::find($this->id);
            $validated['name'] = $this->name;
            $validated['email'] = $this->email;
            $validated['admin_id'] = $this->admin_id;
            $user->update($validated);
            $user->save();
            $this->alert('success', Lang::get('messages.user_update'));
            
        }catch(\Exception $e){
            $this->alert('error', 'Something went wrong.');
        }
    }


    public function render()
    {
        return view('admin.users.user-edit-component');
    }
}
