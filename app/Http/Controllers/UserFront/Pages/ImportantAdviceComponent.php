<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class ImportantAdviceComponent extends Component
{

    public function getImportantAdvice()
    {
        $agent =  Content::where('page_id', 13)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.important-advice-component', [
            'importantAdvice' => $this->getImportantAdvice()
        ]);
    }
}
