<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class UzbekistanComponent extends Component
{
    public function getUzbekistan()
    {
        $agent =  Content::where('page_id', 22)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.uzbekistan-component', [
            'Uzbekistan' => $this->getUzbekistan()
        ]);
    }
}
