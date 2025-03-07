<?php

namespace App\Http\Controllers\Agent\Tool\ImageGallery;
use Livewire\Attributes\Layout;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use App\Models\Agent\EventMaster;
use Livewire\Component;

class ImageGalleryListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $title, $search_title,$imagegalleryId ;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getImageGallery()
    {

        // dd(auth()->user('agent')->id);
        return EventMaster::query()
            // ->where('agent_id', auth()->user('agent')->id)
            ->searchLike('title', $this->search_title)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterImageGallery()
    {
        $this->resetPage();
    }

    public function toggleStatus(EventMaster $imageGallery)
    {
        // dd($imageGallery);
        $this->imagegalleryId = $imageGallery->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->imagegalleryId);

        $imagegalleryData = EventMaster::whereId($this->imagegalleryId);
        // dd($imagegalleryData);
        $imagegalleryData->update(['is_active' => !$imagegalleryData->first()->is_active]);
        $this->alert('success', Lang::get('messages.image_gallery_status_changed'));
    }

    public function isDelete(EventMaster $imageGallery)
    {
        // dd($imageGallery);
        $this->imagegalleryId = $imageGallery->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $imagegalleryData = EventMaster::whereId($this->imagegalleryId);
        //   dd($imagegalleryData);
        $imagegalleryData->delete();
        $this->alert('success', Lang::get('messages.image_gallery_delete'));
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.image-gallery.image-gallery-list-component',[
            'imageGallerys' => $this->getImageGallery(),
        ]);
    }
}
