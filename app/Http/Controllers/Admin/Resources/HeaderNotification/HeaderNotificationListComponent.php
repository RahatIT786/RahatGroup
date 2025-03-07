<?php

namespace App\Http\Controllers\Admin\Resources\HeaderNotification;

use App\Models\HeaderNotification;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class HeaderNotificationListComponent extends Component
{
    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $content_modal_data, $search_type, $NotificationId, $headnotificationStsId, $Id;
    public function getHeaderNotification()
    {
        return HeaderNotification::query()
            ->searchLike('bg_color', $this->search_type)
            ->desc()
            ->paginate($this->perPage);
    }
    public function isDelete(HeaderNotification $HeaderNotification)
    {
        $this->NotificationId = $HeaderNotification->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $notificationData = HeaderNotification::whereId($this->NotificationId);
        $notificationData->delete();
        $this->alert('success', Lang::get('messages.headerNotification_delete'));
    }
    public function toggleStatus(HeaderNotification $headnotificationSts)
    {
        // dd($user);
        $this->headnotificationStsId = $headnotificationSts->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $headnotificationStsData = HeaderNotification::whereId($this->headnotificationStsId);
        $headnotificationStsData->update(['is_active' => !$headnotificationStsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.headerNotification_status_changed'));
    }
    public function isDupicate(HeaderNotification $notification)
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
            $notificationData = HeaderNotification::find($this->Id);
            $copynotificationData = [
                'bg_color' => $notificationData->bg_color,
                'notifi_contain' => $notificationData->notifi_contain,
                'is_active' => $notificationData->is_active,
            ];
            HeaderNotification::create($copynotificationData);
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
    public function getContent(HeaderNotification $notification)
    {
        $this->content_modal_data = $notification;
    }
    public function render()
    {
        return view('admin.resources.header-notification.header-notification-list-component', [
            'HeaderNotification' => $this->getHeaderNotification()
        ]);
    }
}
