<?php

namespace App\Http\Controllers\User\Pages;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class KarbalaKufaNajafComponent extends Component
{
    public function getKarbalaKufa()
    {
        $agent =  Content::where('page_id', 18)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.karbala-kufa-najaf-component', [
            'karbalaKufa' => $this->getKarbalaKufa()
        ]);
    }
}
