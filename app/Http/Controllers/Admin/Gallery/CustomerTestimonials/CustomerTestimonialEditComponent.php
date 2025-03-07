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

class CustomerTestimonialEditComponent extends Component
{

    public $name, $image, $city_name, $description, $id, $testimonial_imgEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(CustomerTestimonial $testimonial)
    {
        $this->id = $testimonial->id;
        $this->name = $testimonial->name;
        $this->city_name = $testimonial->city_name;
        $this->description = $testimonial->description;
        $this->testimonial_imgEdit = $testimonial->image;
    }

    public function update()
    {
        $testimonial = CustomerTestimonial::whereId($this->id)->first();
        $validated = $this->validate([
            'name' => 'required',
            'city_name' => 'required',
            'description' => 'required',
            'image' => 'nullable',

        ]);
        if ($this->image) {
            if ($testimonial->image) {
                Storage::delete('public/cust_testimonial_image/' . $testimonial->image);
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/cust_testimonial_image', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $testimonial->image;
        }

        CustomerTestimonial::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.testimonial_update'));
        return to_route('admin.custTestimonial.index');
    }

    public function render()
    {
        return view('admin.gallery.customer-testimonials.customer-testimonial-edit-component');
    }
}
