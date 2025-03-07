<?php

namespace App\Http\Controllers\Agent\Tool\VideoGallery;

use App\Models\Agent\Video;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Livewire\Component;

class VideoGalleryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $search_title, $search_event_date, $videoId, $videoGalleryId;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getVideoGallery()
    {
        return Video::query()
            // ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('title', $this->search_title)
            // ->searchLike('event_date', $this->search_event_date)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterVideoGallery()
    {
        $this->resetPage();
    }

    public function toggleStatus(Video $video)
    {
        $this->videoId = $video->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $videoData = Video::whereId($this->videoId);
        $videoData->update(['is_active' => !$videoData->first()->is_active]);
        $this->alert('success', Lang::get('messages.video_gallery_status_changed'));
    }

    public function isDelete(Video $videoGallery)
    {
        $this->videoGalleryId = $videoGallery->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $videoGalleryData = Video::whereId($this->videoGalleryId);
        $videoGalleryData->delete();
        $this->alert('success', Lang::get('messages.image_gallery_delete'));
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.video-gallery.video-gallery-list-component', [
            'videoGalleres' => $this->getVideoGallery(),
        ]);
    }
}
