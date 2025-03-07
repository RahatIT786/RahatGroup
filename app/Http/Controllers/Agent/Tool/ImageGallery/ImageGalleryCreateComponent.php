<?php

namespace App\Http\Controllers\Agent\Tool\ImageGallery;

use Livewire\Attributes\Layout;

use App\Models\Agent\EventMaster;
use App\Models\Agent\EventImageMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ImageGalleryCreateComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $title, $event_date, $event_id;
    public $event_img = [];

    public function save()
    {
        $rules = [
            'title' => 'required',
            'event_date' => 'required',
            'event_img.*' => 'required|image|max:2048', // Validate each uploaded image
        ];

        $customMessages = [
            'title.required' => 'Title field is required.',
            'event_date.required' => 'Date field is required.',
            'event_img.*.image' => 'Image field must contain valid image files.',
            'event_img.*.max' => 'Each image must not exceed 2MB in size.',
        ];

        $validated = $this->validate($rules, $customMessages);

        $event = EventMaster::create([
            'title' => $this->title,
            'event_date' => $this->event_date,
            'agent_id' => auth()->user('agent')->id,
        ]);

        foreach ($this->event_img as $img) {
            $uuid = Str::uuid();
            $imageName = $uuid . '.' . $img->getClientOriginalExtension();
            $img->storeAs('public/event_image', $imageName);
            $imageData = [
                'event_id' => $event->id,
                'event_img' => $imageName,
                'is_active' => 1,
            ];
            // dd($imageData);
            EventImageMaster::create($imageData);
        }
        $this->alert('success', Lang::get('messages.image_gallery_save'));
        return to_route('agent.imageGallery.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.image-gallery.image-gallery-create-component');
    }
}
