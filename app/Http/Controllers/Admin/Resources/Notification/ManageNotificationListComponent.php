<?php

namespace App\Http\Controllers\Admin\Resources\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class ManageNotificationListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $Id, $search_type, $NotificationId, $notificationStsId, $status, $id, $is_edit, $AdminId, $content_modal_data;
    public function getNotification()
    {
        return Notification::query()
            ->searchLike('notifi_type', $this->search_type)
            ->desc()
            ->paginate($this->perPage);
    }
    public function isDelete(Notification $notification)
    {
        $this->NotificationId = $notification->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $notificationData = Notification::whereId($this->NotificationId);
        $notificationData->delete();
        $this->alert('success', Lang::get('messages.notification_delete'));
    }
    public function toggleStatus(Notification $notificationSts)
    {
        // dd($user);
        $this->notificationStsId = $notificationSts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $notificationStsData = Notification::whereId($this->notificationStsId);
        $notificationStsData->update(['is_active' => !$notificationStsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.notification_status_changed'));
    }
    public function isDupicate(Notification $notification)
    {
        // dd($notification);
        $this->Id = $notification->id;
        $this->confirm('Are you sure to Duplicate this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDuplicate',
        ]);
    }
    public function confirmDuplicate()
    {
        try {
            $notificationData = Notification::find($this->Id);
            $copynotificationData = [
                'notifi_type' => $notificationData->notifi_type,
                'notifi_contain' => $notificationData->notifi_contain,
                'is_active' => $notificationData->is_active,
            ];
            Notification::create($copynotificationData);
        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            Log::error('Error creating new notification content: ' . $e->getMessage());
        }
        $this->alert('success', 'Record has been Duplicated successfully');
    }
    public function filterNotification()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }
    public function getContent(Notification $notification)
    {
        $this->content_modal_data = $notification;
    }
    public function render()
    {
        return view('admin.resources.notification.manage-notification-list-component', [
            'Notification' => $this->getNotification()
        ]);
    }
}
