<?php

namespace App\Http\Controllers\Admin\Gallery\Testimonials;

use App\Models\City;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestimonialCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $title, $tour_type, $city_id, $city, $description, $video_url, $image;

    public function mount()
    {
        $this->city = City::pluck('city_name', 'id');
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required',
            'tour_type' => 'required',
            'description' => 'required',
            'city_id' => 'required',
            'video_url' => 'required',
            'image' => 'required|image|max:1024',
        ], [], [
            'city_id' => 'city',
        ]);
        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;

        // Store the profile image in the storage/app/public directory
        Storage::putFileAs('public/testimonial_image', $validated['image'], $imageName);

        $validated['image'] = $imageName;

        Testimonial::create($validated);
        $this->alert('success', Lang::get('messages.testimonial_save'));
        return to_route('admin.testimonial.index');
    }

    public function render()
    {
        return view('admin.gallery.testimonials.testimonial-create-component');
    }
}
