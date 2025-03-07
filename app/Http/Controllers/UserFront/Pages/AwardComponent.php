<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Award;

class AwardComponent extends Component
{

    public function getAward()
    {
        return Award::active()->desc()->with('awardimage')->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.award-component', [
            'awards' => $this->getAward()
        ]);
    }
}
