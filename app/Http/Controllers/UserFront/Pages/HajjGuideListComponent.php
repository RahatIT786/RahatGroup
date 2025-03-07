<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class HajjGuideListComponent extends Component
{

    public function getHajjGuide()
    {
        $hajjGuide = Content::where('id', 1)->first();

        return $hajjGuide;
    }


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.hajj-guide-list-component', [
            'QsHajj' => $this->getHajjGuide()
        ]);
    }
}
