<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\IntHolidayTour;
use App\Models\PackageType;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class IntTourDetailsLComponent extends Component
{   
    use LivewireAlert;
    public $tours,$packageTypes,$selectedPackageType;
    public function mount($slug)
    {
        $this->tours = IntHolidayTour::where('is_active', 1)
            ->where('slug', $slug)->with('country', 'tourImages', 'tourDetails')->first();
        

        $pkg_type_ids = explode(',',$this->tours->tour_types);
        // dd($pkg_type_ids);
       $this->packageTypes = PackageType::whereIn('id',$pkg_type_ids)->get();
    }

    public function changeType()
    {
        
    }
    
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.int-tour-details-l-component');
    }
}
