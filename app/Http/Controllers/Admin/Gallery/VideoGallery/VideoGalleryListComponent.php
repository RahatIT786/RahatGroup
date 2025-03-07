<?php

namespace App\Http\Controllers\Admin\Gallery\VideoGallery;

use App\Models\VGallery;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class VideoGalleryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $perPage = 10, $Id, $package_type;

    public function getVideos()
    {
        return VGallery::desc()
            ->with('packageType')
            ->searchpackage($this->package_type)
            ->paginate($this->perPage);
    }

    public function isDelete(VGallery $vGallery)
    {
        $this->Id = $vGallery->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $vGalleryData = VGallery::whereId($this->Id);
        $vGalleryData->delete();
        $this->alert('success', Lang::get('messages.video_gallery_delete'));
    }

    public function toggleStatus(VGallery $video)
    {
        $this->Id = $video->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $vGalleryData = VGallery::whereId($this->Id);
        $vGalleryData->update(['is_active' => !$vGalleryData->first()->is_active]);
        $this->alert('success', Lang::get('messages.video_gallery_status_changed'));
    }

    public function filtervideo()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.gallery.video-gallery.video-gallery-list-component', [
            'videos' => $this->getVideos()
        ]);
    }
}
