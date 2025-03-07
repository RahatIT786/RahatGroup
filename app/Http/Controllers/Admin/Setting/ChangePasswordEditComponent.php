<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class ChangePasswordEditComponent extends Component
{
    use LivewireAlert;
    public $old_password, $new_password, $confirm_password;
    
    public function updatePassword()
    {
        $validated = $this->validate([
            'old_password' => ['required', 'min:8', function ($attribute, $value, $fail) {
                // Custom validation logic here
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

        // dd($validated);
        // Update the password
        $user = Auth::user();
        $user->update(['password' => Hash::make($this->new_password)]);
        $user->save();
        $this->alert('success', Lang::get('messages.user_password'));
        // Redirect with success message
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('admin.setting.change-password-edit-component');
    }
}
