<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class AuthorisedAgentsListComponent extends Component
{


    public function getAgent()
    {   
        // dd('hi');
        // dd(Content::where('page_id', 8)->first());
        $agent =  Content::where('page_id', 2)->with('pagecontent')->first(); 
        return $agent;
        // dd($agent);
        // $agent =  Content::get(); 
        
        // dd($agent);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.authorised-agents-list-component', [
            'QsAgent' => $this->getAgent()
        ]);
    }


}
