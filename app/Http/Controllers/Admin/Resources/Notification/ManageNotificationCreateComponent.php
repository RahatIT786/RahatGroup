<?php

namespace App\Http\Controllers\Admin\Resources\Notification;

use App\Models\Notification;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ManageNotificationCreateComponent extends Component
{
    public $notifi_type, $notifi_contain;
    use LivewireAlert;

    public function save()
    {
        $validated = $this->validate([
            'notifi_type' => 'required',
            'notifi_contain' => 'required',
        ], [], [
            'notifi_type' => 'Type',
            'notifi_contain' => 'Content',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        Notification::create($validated);
        $this->alert('success', Lang::get('messages.notification_save'));
        return to_route('admin.manageNotification.index');
    }
    public function render()
    {
        return view('admin.resources.notification.manage-notification-create-component');
    }
}
