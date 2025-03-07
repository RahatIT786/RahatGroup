<?php

namespace App\Http\Controllers\Agent\Tool\ImageGallery;

use Livewire\Attributes\Layout;

use App\Models\Agent\EventMaster;
use App\Models\Agent\EventImageMaster;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageGalleryEditComponent extends Component
{
    public $title, $event_date, $id, $eventimage, $event_id;
    public $event_img = [];
    use LivewireAlert;
    use WithFileUploads;

    public function mount(EventMaster $eventmaster)
    {
        $this->id = $eventmaster->id;
        $this->title = $eventmaster->title;
        $this->event_date = $eventmaster->event_date;
        $this->eventimage = EventImageMaster::where('event_id', $this->id)->pluck('event_img', 'id');
    }

    public function update()
    {
        $rules = [
            'title' => 'required',
            'event_date' => 'required',
            'event_img.*' => 'sometimes|image',
        ];
        $validationAttributes = [
            'title.required' => 'Title field is required.',
            'event_date.required' => 'Date field is required.',
        ];
        $validated = $this->validate($rules, [], $validationAttributes);

        $imagegallery = EventMaster::find($this->id);
        $imagegallery->update([
            'title' => $validated['title'],
            'event_date' => $validated['event_date'],
        ]);

        if ($this->event_img) {
            foreach ($this->event_img as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/event_image', $photo, $imageName);
                EventImageMaster::create([
                    'event_id' => $imagegallery->id,
                    'event_img' => $imageName,
                ]);
            }
        }

        $this->alert('success', Lang::get('messages.image_gallery_update'));
        return redirect()->route('agent.imageGallery.index');
    }

    public function deleteImage($imageId)
    {
        $image = EventImageMaster::find($imageId);
        if ($image) {
            Storage::delete('public/event_image/' . $image->event_img);
            $image->delete();
            $this->eventimage = EventImageMaster::where('event_id', $this->id)->pluck('event_img', 'id');
            $this->alert('success', Lang::get('messages.image_deleted'));
        }
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.tool.image-gallery.image-gallery-edit-component');
    }
}
