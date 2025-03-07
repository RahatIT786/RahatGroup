<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\HolidayTour;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class DomesticTourDetailsLComponent extends Component
{
    use LivewireAlert;
    public $tours;
    public function mount($slug)
    {
        $this->tours = HolidayTour::where('is_active', 1)
            ->where('slug', $slug)->with('state', 'tourImages', 'tourDetails')->first();
        // $this->nights = 
       
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.domestic-tour-details-component');
    }
}
