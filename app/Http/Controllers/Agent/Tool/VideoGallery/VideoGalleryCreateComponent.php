<?php

namespace App\Http\Controllers\Agent\Tool\VideoGallery;

use App\Models\Agent\Video;
use Illuminate\Support\Facades\Lang;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class VideoGalleryCreateComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $image, $videos, $agent_id, $title, $event_date, $video;

    public function save()
    {
        $rules = [
            'title' => 'required',
            'event_date' => 'required',
            'image' => 'required|image|max:2048',
            'video' => 'required|url',
        ];

        $customMessages = [
            'title.required' => 'Title field is required.',
            'event_date.required' => 'Date field is required.',
            'image.image' => 'The file must be a valid image.',
            'image.max' => 'The image must not exceed 2MB in size.',
            'video' => 'video URL field is required.',
        ];

        $validated = $this->validate($rules, $customMessages);

        // Handle image upload
        $uuid = Str::uuid();
        $imageName = $uuid . '.' . $this->image->getClientOriginalExtension();
        $this->image->storeAs('public/event_image', $imageName);

        Video::create([
            'title' => $this->title,
            'event_date' => $this->event_date,
            'agent_id' => auth()->user()->id,
            'image' => $imageName,
            'video' => $this->video,
        ]);

        $this->alert('success', Lang::get('messages.video_gallery_save'));
        return redirect()->route('agent.videoGallery.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.video-gallery.video-gallery-create-component');
    }
}
