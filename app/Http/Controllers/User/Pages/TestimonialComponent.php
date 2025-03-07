<?php

namespace App\Http\Controllers\User\Pages;

use App\Models\City;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TestimonialComponent extends Component
{
    public $tour_type = [];
    public $type = [];
    public $video = [];
    public $citytype = [];
    public $cityType;

    public function mount()
    {
        $this->cityType = City::pluck('city_name', 'id');
        $this->video = $this->getTestimonial();
    }

    public function getTestimonial()
    {
        return Testimonial::desc()
            ->when($this->tour_type, function ($query) {
                $query->whereIn('tour_type', $this->tour_type);
            })
            ->when($this->citytype, function ($query) {
                $query->whereIn('city_id', $this->citytype);
            })
            ->get();
    }

    public function getTourType($tourtype)
    {
        if (!is_array($this->tour_type)) {
            $this->tour_type = [];
        }
        $this->video = $this->getTestimonial();
    }

    public function getCityType($citytype)
    {
        if (!is_array($this->citytype)) {
            $this->citytype = [];
        }
        $this->video = $this->getTestimonial();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.testimonial-component', [
            'testimonials' => $this->getTestimonial()
        ]);
    }
}
