<?php

namespace App\Http\Controllers\Admin\Gallery\VideoGallery;

use App\Models\GalleryVideo;
use App\Models\PackageType;
use App\Models\VGallery;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class VideoGalleryEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $packageType, $id, $service_id, $type, $package_id, $galleyimage, $eventvideo, $video_url;
    public $video = [];
    public $existingVideos = [];

    public function mount(VGallery $video)
    {
        $this->id = $video->id;
        $this->service_id = $video->service_id;
        $this->package_id = $video->package_id;
        $this->type = $video->type;
        $this->packageType = PackageType::pluck('package_type', 'id');

        // Load existing videos
        $existingVideos = GalleryVideo::where('v_gallery_id', $video->id)->get();
        foreach ($existingVideos as $existingVideo) {
            $this->existingVideos[] = [
                'id' => $existingVideo->id,
                'video' => $existingVideo->video
            ];
        }
    }

    public function update()
    {
        $rules = [
            'service_id' => 'required',
            'package_id' => 'required',
            'type' => 'required',
            'existingVideos.*.video' => 'required|url', // Ensure each video URL is valid
        ];

        $validationAttributes = [
            'service_id' => 'service',
            'package_id' => 'package',
            'existingVideos.*.video' => 'video URL',
        ];

        $validated = $this->validate($rules, [], $validationAttributes);

        $videogallery = VGallery::find($this->id);
        $videogallery->update([
            'service_id' => $validated['service_id'],
            'package_id' => $validated['package_id'],
            'type' => $validated['type'],
        ]);

        // Update existing videos or create new ones
        foreach ($this->existingVideos as $videoData) {
            if (isset($videoData['id'])) {
                GalleryVideo::where('id', $videoData['id'])->update([
                    'video' => $videoData['video'],
                ]);
            } else {
                GalleryVideo::create([
                    'v_gallery_id' => $this->id,
                    'video' => $videoData['video'],
                    'is_active' => 1,
                ]);
            }
        }

        $this->alert('success', Lang::get('messages.video_gallery_update'));
        return redirect()->route('admin.videoGallery.index');
    }

    public function addVideo()
    {
        $this->existingVideos[] = ['video' => ''];
    }

    public function removeVideo($index)
    {
        if (isset($this->existingVideos[$index]['id'])) {
            GalleryVideo::where('id', $this->existingVideos[$index]['id'])->delete();
        }
        unset($this->existingVideos[$index]);
        $this->existingVideos = array_values($this->existingVideos); // Reindex the array
    }

    public function render()
    {
        return view('admin.gallery.video-gallery.video-gallery-edit-component');
    }
}


// class VideoGalleryEditComponent extends Component
// {
//     use LivewireAlert, WithFileUploads;
//     public $packageType, $id, $service_id, $type, $package_id, $galleyimage, $eventvideo, $video_url;
//     public $video = [];
//     public $photoEdit = [];

//     public function mount(VGallery $video)
//     {
//         $this->id = $video->id;
//         $this->service_id = $video->service_id;
//         $this->package_id = $video->package_id;
//         $this->type = $video->type;
//         $this->video_url = $video->video_url;
//         $this->packageType = PackageType::pluck('package_type', 'id');
//         $this->photoEdit = GalleryVideo::where('v_gallery_id', $this->id)->pluck('video', 'id')->toArray();
//     }

//     public function update()
//     {
//         $rules = [
//             'service_id' => 'required',
//             'package_id' => 'required',
//             'type' => 'required',
//             'video.*' => 'required|mimetypes:video/mp4,video/x-m4v,video/*|max:10240',
//             // 'video.*' => 'required|mimetypes:video',

//         ];

//         $validationAttributes = [
//             'service_id' => 'service',
//             'package_id' => 'package',
//         ];

//         $validated = $this->validate($rules, [], $validationAttributes);

//         $videogallery = VGallery::find($this->id);
//         $videogallery->update([
//             'service_id' => $validated['service_id'],
//             'package_id' => $validated['package_id'],
//             'type' => $validated['type'],
//         ]);

//         if ($this->video) {
//             foreach ($this->video as $v) {
//                 $uuid = Str::uuid();
//                 $videoExtension = $v->getClientOriginalExtension();
//                 $videoName = $uuid . '.' . $videoExtension;
//                 Storage::putFileAs('public/video_gallery', $v, $videoName);
//                 GalleryVideo::create([
//                     'v_gallery_id' => $videogallery->id,
//                     'video' => $videoName,
//                     'is_active' => 1,
//                 ]);
//             }
//         }

//         // $validated = $this->validate([
//         //     'service_id' => 'required',
//         //     'package_id' => 'required',
//         //     'type' => 'required',
//         //     'video_url' => 'required',
//         // ], [], [
//         //     'service_id' => 'service',
//         //     'package_id' => 'package',
//         // ]);

//         VGallery::whereId($this->id)->update($validated);

//         $this->alert('success', Lang::get('messages.video_gallery_update'));
//         return redirect()->route('admin.videoGallery.index');
//     }

//     public function deleteVideo($videoId)
//     {
//         $video = GalleryVideo::find($videoId);
//         if ($video) {
//             // Delete video file from storage
//             Storage::delete('public/video_gallery/' . $video->video);

//             // Delete video record from database
//             $video->delete();

//             // Refresh the list of edited photos
//             $this->photoEdit = GalleryVideo::where('v_gallery_id', $this->id)->pluck('video', 'id')->toArray();

//             // Show success message
//             $this->alert('success', Lang::get('messages.video_deleted'));
//         }
//     }

//     public function render()
//     {
//         return view('admin.gallery.video-gallery.video-gallery-edit-component');
//     }
// }
