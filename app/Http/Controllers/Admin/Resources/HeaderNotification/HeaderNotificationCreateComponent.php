<?php

namespace App\Http\Controllers\Admin\Resources\HeaderNotification;

use App\Models\HeaderNotification;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class HeaderNotificationCreateComponent extends Component
{
    public $bg_color, $notifi_contain;
    use LivewireAlert;

    public function save()
    {
        $validated = $this->validate([
            'bg_color' => 'required',
            'notifi_contain' => 'required',
        ], [], [
            'bg_color' => 'background color',
            'notifi_contain' => 'header content',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        HeaderNotification::create($validated);
        $this->alert('success', Lang::get('messages.Header_notification_save'));
        return to_route('admin.headerNotification.index');
    }
    public function render()
    {
        return view('admin.resources.header-notification.header-notification-create-component');
    }
}
