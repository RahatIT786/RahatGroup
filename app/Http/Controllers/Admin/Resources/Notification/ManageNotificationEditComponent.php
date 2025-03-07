<?php

namespace App\Http\Controllers\Admin\Resources\Notification;

use App\Models\Notification;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class ManageNotificationEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $notifi_type, $is_edit, $notifi_contain, $Id;

    public function mount(Notification $notification)
    {
        $this->Id = $notification->id;
        $this->notifi_type = $notification->notifi_type;
        $this->notifi_contain = $notification->notifi_contain;
    }

    public function update()
    {
        $validated = $this->validate([
            'notifi_type' => 'required',
            'notifi_contain' => 'required',
        ], [], [
            'notifi_type' => 'Type',
            'notifi_contain' => 'Content',
        ]);
        // $validated['is_active'] = $this->status ?? 1;

        $notify = Notification::find($this->Id);
        $notify->update($validated);

        $this->alert('success', Lang::get('messages.notification_update'));

        return to_route('admin.manageNotification.index');
    }
    public function render()
    {
        return view('admin.resources.notification.manage-notification-edit-component');
    }
}
