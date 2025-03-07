<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class DirectorsSpeakComponent extends Component
{

    public function getDirectorsSpeak()
    {
        $director =  Content::where('page_id', 5)->with('pagecontent')->first();
        // dd($director);
        return $director;
    }


    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.directors-speak-component', [
            'directors' => $this->getDirectorsSpeak()
        ]);
    }
}
