<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Award;

class AwardsDetailsComponent extends Component
{
    public $award;

    public function mount($id)
    {
    
        $this->award = Award::where('id', $id)->first();
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
       
        
        return view('user.pages.awards-details-component');
    }
}
