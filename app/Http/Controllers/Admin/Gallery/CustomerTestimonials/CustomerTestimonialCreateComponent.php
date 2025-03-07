<?php

namespace App\Http\Controllers\Admin\Gallery\CustomerTestimonials;

use App\Models\CustomerTestimonial;
use App\Models\Publication;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerTestimonialCreateComponent extends Component
{
    public $name, $image, $city_name, $description;
    use LivewireAlert;
    use WithFileUploads;

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required',
            'city_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:1024',
        ]);

        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/cust_testimonial_image', $validated['image'], $imageName);
        $validated['image'] = $imageName;
        CustomerTestimonial::create($validated);
        $this->alert('success', Lang::get('messages.testimonial_save'));
        return to_route('admin.custTestimonial.index');
    }

    public function render()
    {
        return view('admin.gallery.customer-testimonials.customer-testimonial-create-component');
    }
}
