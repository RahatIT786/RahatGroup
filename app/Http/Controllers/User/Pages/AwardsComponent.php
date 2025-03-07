<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Award;

class AwardsComponent extends Component
{
    public function getAward()
    {
        return Award::active()->desc()->with('awardimage')->get();
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.awards-component', [
            'awards' => $this->getAward()
        ]);
    }
}
