<?php

namespace App\Http\Controllers\Admin\Resources\HeaderNotification;

use App\Models\HeaderNotification;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;

class HeaderNotificationEditComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $Id, $bg_color, $notifi_contain;

    public function mount(HeaderNotification $headernotification)
    {
        $this->Id = $headernotification->id;
        $this->bg_color = $headernotification->bg_color;
        $this->notifi_contain = $headernotification->notifi_contain;
    }
    public function update()
    {
        $validated = $this->validate([
            'bg_color' => 'required',
            'notifi_contain' => 'required',
        ], [], [
            'bg_color' => 'background color',
            'notifi_contain' => 'header content',
        ]);
        // $validated['is_active'] = $this->status ?? 1;

        $notify = HeaderNotification::find($this->Id);
        $notify->update($validated);
        $this->alert('success', Lang::get('messages.notification_update'));
        return to_route('admin.headerNotification.index');
    }
    public function render()
    {
        return view('admin.resources.header-notification.header-notification-edit-component');
    }
}
