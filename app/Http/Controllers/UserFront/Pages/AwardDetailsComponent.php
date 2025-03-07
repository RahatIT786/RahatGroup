<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Award;

class AwardDetailsComponent extends Component
{
    public $award;

    public function mount($id)
    {
        $this->award = Award::where('id', $id)->first();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.award-details-component');
    }
}
