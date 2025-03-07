<?php

namespace App\Http\Controllers\Admin\Gallery\ImageGallery;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\PackageType;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ImageGalleryEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $packageType, $id, $service_id, $type, $package_id, $galleyimage, $eventimage, $facebook_link;
    public $photoEdit = [];
    public $imageUpload = [];

    public function mount(Gallery $image)
    {
        $this->id = $image->id;
        $this->service_id = $image->service_id;
        $this->package_id = $image->package_id;
        $this->type = $image->type;
        $this->facebook_link = $image->facebook_link;
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->photoEdit = GalleryImage::where('gallery_id', $this->id)->pluck('image', 'id')->toArray();
        // dd($this->imageUpload);
    }

    public function update()
    {
        $rules = [
            'service_id' => 'required',
            'package_id' => 'required',
            'type' => 'required',
            'facebook_link' => 'required|url',
            // 'image.*' => 'sometimes|image',
        ];

        $validationAttributes = [
            'service_id' => 'service',
            'package_id' => 'package',
            'facebook_link' => 'Facebook link'
        ];
        // dd($this->imageUpload);
        $validated = $this->validate($rules, [], $validationAttributes);

        $imagegallery = Gallery::find($this->id);
        $imagegallery->update([
            'service_id' => $validated['service_id'],
            'package_id' => $validated['package_id'],
            'type' => $validated['type'],
            'facebook_link' => $validated['facebook_link'],
        ]);

        if ($this->imageUpload) {
            foreach ($this->imageUpload as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/image_gallery', $photo, $imageName);
                GalleryImage::create([
                    'gallery_id' => $imagegallery->id,
                    'image' => $imageName,
                ]);
            }
        }

        $this->alert('success', Lang::get('messages.image_gallery_update'));
        return redirect()->route('admin.imageGallery.index');
    }

    public function deleteImage($imageId)
    {
        $image = GalleryImage::find($imageId);
        if ($image) {
            Storage::delete('public/image_gallery/' . $image->image);
            $image->delete();
            $this->eventimage = GalleryImage::where('gallery_id', $this->id)->pluck('image', 'id');
            $this->alert('success', Lang::get('messages.image_deleted'));
        }
    }

    public function render()
    {
        return view('admin.gallery.image-gallery.image-gallery-edit-component');
    }
}
