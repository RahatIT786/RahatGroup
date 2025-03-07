<?php

namespace App\Http\Controllers\Admin\Gallery\ImageGallery;

use App\Models\PackageType;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageGalleryCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $service_id, $package_id, $type, $image, $packageType, $facebook_link;

    public function mount()
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
    }

    public function save()
    {
        $rules = [
            'service_id' => 'required',
            'package_id' => 'required',
            'type' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_link' => 'required|url',
            // 'image.*' => 'required|image',
        ];

        $validationAttributes = [
            'service_id' => 'service',
            'package_id' => 'package',
            'facebook_link' => 'Facebook link'
        ];
        $validated = $this->validate($rules, [], $validationAttributes);

        $gallery = Gallery::create([
            'service_id' => $validated['service_id'],
            'package_id' => $validated['package_id'],
            'type' => $validated['type'],
            'facebook_link' => $validated['facebook_link'],
        ]);
        // dd($this->image);
        foreach ($this->image as $photo) {
            // dd($photo);
            $uuid = Str::uuid();
            $imageExtension = $photo->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $photo->storeAs('public/image_gallery', $imageName);
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image' => $imageName,
                'is_active' => 1,
            ]);
        }
        $this->alert('success', Lang::get('messages.img_gallery_save'));
        return redirect()->route('admin.imageGallery.index');
    }

    public function render()
    {
        return view('admin.gallery.image-gallery.image-gallery-create-component');
    }
}
