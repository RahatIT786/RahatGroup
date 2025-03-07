<?php

namespace App\Http\Controllers\Admin\Gallery\VideoGallery;

use App\Models\GalleryVideo;
use App\Models\PackageType;
use App\Models\VGallery;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideoGalleryCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $service_id, $package_id, $type, $packageType;
    public $video = [];

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
            'video.*' => 'required|url', // Ensure each video URL is valid
        ];

        $validationAttributes = [
            'service_id' => 'service',
            'package_id' => 'package',
            'video.*' => 'video URL',
        ];

        $validated = $this->validate($rules, [], $validationAttributes);

        $gallery = VGallery::create([
            'service_id' => $validated['service_id'],
            'package_id' => $validated['package_id'],
            'type' => $validated['type'],
        ]);

        foreach ($validated['video'] as $videoUrl) {
            GalleryVideo::create([
                'v_gallery_id' => $gallery->id,
                'video' => $videoUrl,
                'is_active' => 1,
            ]);
        }

        session()->flash('success', Lang::get('messages.video_gallery_save'));
        return redirect()->route('admin.videoGallery.index');
    }

    public function addVideo()
    {
        $this->video[] = '';
    }

    public function removeVideo($index)
    {
        unset($this->video[$index]);
        $this->video = array_values($this->video); // Reindex the array
    }

    public function render()
    {
        return view('admin.gallery.video-gallery.video-gallery-create-component');
    }
}
