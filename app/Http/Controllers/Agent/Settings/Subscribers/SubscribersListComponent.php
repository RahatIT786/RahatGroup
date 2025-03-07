<?php

namespace App\Http\Controllers\Agent\Settings\Subscribers;
use Livewire\Attributes\Layout;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Agent\Subscribers;
use Livewire\Component;

class SubscribersListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10,$email, $search_email, $subscriberId = null ;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getSubscribers()
    {
        // dd(auth()->user('agent')->id);
        return Subscribers::query()
            ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('email', $this->search_email)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterSubscriberEmail()
    {
        $this->resetPage();
    }

    public function toggleStatus(Subscribers $subscribers)
    {
        $this->subscriberId = $subscribers->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    
    public function confirmed()
    {
        $subscriberData = Subscribers::find($this->subscriberId);
    
        if ($subscriberData) {
            $subscriberData->is_active = !$subscriberData->is_active;
            $subscriberData->save();
    
            $this->alert('success', Lang::get('messages.subscriber_status_changed'));
        } else {
            $this->alert('error', Lang::get('messages.subscriber_not_found'));
        }
    }
    

    public function isDelete(Subscribers $subscribers)
    {
        // dd($subscribers);
        $this->subscriberId = $subscribers->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $subscriberData = Subscribers::whereId($this->subscriberId);
        //   dd($subscriberData);
        $subscriberData->delete();
        $this->alert('success', Lang::get('messages.subscriber_delete'));
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.subscribers.subscribers-list-component',[
            'subscribers' => $this->getSubscribers()
        ]);
    }
}
