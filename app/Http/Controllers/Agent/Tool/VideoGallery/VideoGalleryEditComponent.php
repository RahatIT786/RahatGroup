<?php

namespace App\Http\Controllers\Agent\Tool\VideoGallery;

use App\Models\Agent\Video;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class VideoGalleryEditComponent extends Component
{
    use WithFileUploads, LivewireAlert;

    public $title, $event_date, $id, $image, $video, $imageEdit;

    public function mount(Video $video)
    {
        $this->id = $video->id;
        $this->title = $video->title;
        $this->event_date = $video->event_date;
        $this->imageEdit = $video->image;
        $this->video = $video->video;
    }

    public function update()
    {
        $validated = $this->validate([
            'title' => 'required',
            'event_date' => 'required',
            'image' => 'nullable|image|max:2048',
            'video' => 'required|url',
        ]);

        $videoData = Video::findOrFail($this->id);

        if ($this->image) {
            if ($videoData->image) {
                Storage::delete('public/event_image/' . $videoData->image);
            }
            $imageName = Str::uuid() . '.' . $this->image->getClientOriginalExtension();
            Storage::putFileAs('public/event_image', $this->image, $imageName);
            $validated['image'] = $imageName;
        } else {
            $validated['image'] = $videoData->image;
        }

        $videoData->update($validated);

        $this->alert('success', 'Video gallery updated successfully');
        return redirect()->route('agent.videoGallery.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.video-gallery.video-gallery-edit-component');
    }
}
