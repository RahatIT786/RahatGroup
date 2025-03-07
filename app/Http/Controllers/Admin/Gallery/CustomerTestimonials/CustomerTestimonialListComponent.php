<?php

namespace App\Http\Controllers\Admin\Gallery\CustomerTestimonials;

use App\Models\CustomerTestimonial;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class CustomerTestimonialListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $name, $image, $description, $city_name, $search_name, $testimonialstatusId, $testimonialDeleteId, $desc_modal_data;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getTestimonial()
    {
        return CustomerTestimonial::query()
            ->searchLike('name', $this->search_name)
            ->desc()
            ->paginate($this->perPage);
    }

    public function filterTestimonial()
    {
        $this->resetPage();
    }

    public function toggleStatus(CustomerTestimonial $testimonial)
    {
        $this->testimonialstatusId = $testimonial->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        $testimonialsData = CustomerTestimonial::whereId($this->testimonialstatusId);
        $testimonialsData->update(['is_active' => !$testimonialsData->first()->is_active]);
        $this->alert('success', Lang::get('messages.testimonia_status_changed'));
    }

    public function isDelete(CustomerTestimonial $testimonial)
    {
        // dd($testimonial);
        $this->testimonialDeleteId = $testimonial->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $testimonialDeleteData = CustomerTestimonial::whereId($this->testimonialDeleteId);
        $testimonialDeleteData->delete();
        $this->alert('success', Lang::get('messages.testimonia_delete'));
    }

    public function getDesc(CustomerTestimonial $testimonial)
    {
        $this->desc_modal_data = $testimonial;
    }

    public function render()
    {
        return view('admin.gallery.customer-testimonials.customer-testimonial-list-component', [
            'testimonials' => $this->getTestimonial(),
        ]);
    }
}
