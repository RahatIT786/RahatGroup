<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class JobOpeningsComponent extends Component
{

    public function getJob()
    {
        $agent =  Content::where('page_id', 8)->with('pagecontent')->first();
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.job-openings-component', [
            'jobOpnings' => $this->getJob()
        ]);
    }
}
