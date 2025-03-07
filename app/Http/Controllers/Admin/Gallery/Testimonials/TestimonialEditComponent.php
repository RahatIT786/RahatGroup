<?php

namespace App\Http\Controllers\Admin\Gallery\Testimonials;

use App\Models\City;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestimonialEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $id, $title, $tour_type, $city_id, $city, $description, $video_url, $image, $photoEdit;

    public function mount(Testimonial $testimonial)
    {
        $this->id = $testimonial->id;
        $this->title = $testimonial->title;
        $this->tour_type = $testimonial->tour_type;
        $this->city_id = $testimonial->city_id;
        $this->description = $testimonial->description;
        $this->video_url = $testimonial->video_url;
        $this->photoEdit = $testimonial->image;
        $this->city = City::pluck('city_name', 'id');
    }

    public function update()
    {
        $validated = $this->validate([
            'title' => 'required',
            'tour_type' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'video_url' => 'required',
            'image' => 'nullable|image|max:1024' // Make image optional and add validation rules
        ], [], [
            'city_id' => 'city',
        ]);

        if (isset($validated['image'])) {
            $uuid = Str::uuid();
            $imageExtension = $validated['image']->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            // Store the profile image in the storage/app/public directory
            Storage::putFileAs('public/testimonial_image', $validated['image'], $imageName);

            $validated['image'] = $imageName;
        } else {
            $validated['image'] = $this->photoEdit; // Use existing image if no new image is uploaded
        }

        Testimonial::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.testimonial_update'));
        return redirect()->route('admin.testimonial.index');
    }

    public function render()
    {
        return view('admin.gallery.testimonials.testimonial-edit-component');
    }
}
