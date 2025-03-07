<?php

namespace App\Http\Controllers\User\Pages;

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
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.azerbaijan-component', [
            'azerBaijan' => $this->getAzerbaijan()
        ]);
    }
}
