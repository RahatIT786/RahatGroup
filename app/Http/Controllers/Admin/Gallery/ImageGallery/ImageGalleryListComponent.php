<?php

namespace App\Http\Controllers\Admin\Gallery\ImageGallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ImageGalleryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $perPage = 10, $Id, $package_type, $service_id;

    public function getImages()
    {
        return Gallery::desc()
            ->with('packageType')
            ->searchpackage($this->package_type)
            ->paginate($this->perPage);
    }

    public function isDelete(Gallery $UserImage)
    {
        $this->Id = $UserImage->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $UserImageData = Gallery::whereId($this->Id);
        $UserImageData->delete();
        $this->alert('success', 'Record has been deleted successfully');
    }

    public function toggleStatus(Gallery $image)
    {
        $this->Id = $image->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $UserImageData = Gallery::whereId($this->Id);
        $UserImageData->update(['is_active' => !$UserImageData->first()->is_active]);
        $this->alert('success', 'Record Status has been updated successfully');
    }

    public function filterImage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.gallery.image-gallery.image-gallery-list-component', [
            'images' => $this->getImages()
        ]);
    }
}
