<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;

class DirectorsSpeakListComponent extends Component
{

    public function getDirectorsSpeak()
    {
        $director =  Content::where('page_id', 5)->with('pagecontent')->first();
        // dd($director);
        return $director;
    }
    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.directors-speak-list-component', [
            'directors' => $this->getDirectorsSpeak()
        ]);
    }
}
