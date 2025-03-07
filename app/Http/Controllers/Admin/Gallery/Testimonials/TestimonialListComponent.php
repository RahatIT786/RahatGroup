<?php

namespace App\Http\Controllers\Admin\Gallery\Testimonials;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TestimonialListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;

    protected $listeners = ['confirmed', 'confirmDelete', 'confirmDuplicate'];
    public $perPage = 10, $Id;

    public function getTestimonial()
    {
        return Testimonial::desc()
            // ->searchpackage($this->package_type)
            ->paginate($this->perPage);
    }

    public function isDelete(Testimonial $Testimonial)
    {
        $this->Id = $Testimonial->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $TestimonialData = Testimonial::whereId($this->Id);
        $TestimonialData->delete();
        $this->alert('success', Lang::get('messages.testimonia_delete'));
    }

    public function toggleStatus(Testimonial $testimonial)
    {
        $this->Id = $testimonial->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }

    public function confirmed()
    {
        $TestimonialData = Testimonial::whereId($this->Id);
        $TestimonialData->update(['is_active' => !$TestimonialData->first()->is_active]);
        $this->alert('success', Lang::get('messages.testimonia_status_changed'));
    }

    public function filterTestimonial()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.gallery.testimonials.testimonial-list-component', [
            'testimonials' => $this->getTestimonial()
        ]);
    }
}
