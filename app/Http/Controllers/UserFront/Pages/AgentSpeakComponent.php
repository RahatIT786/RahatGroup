<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class AgentSpeakComponent extends Component
{
    public function getAgentSpeak()
    {
        $agent =  Content::where('page_id', 35)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.agent-speak-component', [
            'agentspeak' => $this->getAgentSpeak()
        ]);
    }
}
