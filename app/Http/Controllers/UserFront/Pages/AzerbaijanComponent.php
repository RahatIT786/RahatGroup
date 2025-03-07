<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class AzerbaijanComponent extends Component
{

    public function getAzerbaijan()
    {
        $agent =  Content::where('page_id', 21)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.azerbaijan-component', [
            'azerBaijan' => $this->getAzerbaijan()
        ]);
    }
}
