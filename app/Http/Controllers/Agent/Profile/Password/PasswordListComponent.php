<?php

namespace App\Http\Controllers\Agent\Profile\Password;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class PasswordListComponent extends Component
{
    use LivewireAlert;
    public $old_password, $new_password, $confirm_password;
    
    public function save()
    {
             
            $validated = $this->validate([
            'old_password' => ['required', 'min:8', function ($attribute, $value, $fail) {
            $currentPassword = auth()->user()->password;
            if (!Hash::check($value, $currentPassword)) {
            $fail("The entered password doesn't match the current password.");
              }
            }],
                'new_password' => ['required', 'min:8', 'different:old_password'],
                'confirm_password' => ['required', 'min:8', 'same:new_password'],
            ], [], [
                'old_password' => 'Current Password',
                'new_password' => 'New Password',
                'confirm_password' => 'Confirm Password',   
            ]);
        
    
        $user = Auth::user();
        $user->update(['password' => Hash::make($this->new_password)]);
            
        $this->alert('success', Lang::get('messages.user_password'));
        return redirect()->route('agent.dashboard');
       
    }
    
    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.profile.password.password-list-component');
    }
}
