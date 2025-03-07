<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class DubaiLeisureComponent extends Component
{

    public function getDubaileisure()
    {
        $agent =  Content::where('page_id', 17)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.dubai-leisure-component', [
            'dubaiLeisure' => $this->getDubaileisure()
        ]);
    }
}
