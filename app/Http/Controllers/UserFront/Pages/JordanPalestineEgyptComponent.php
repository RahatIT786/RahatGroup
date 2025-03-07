<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class JordanPalestineEgyptComponent extends Component
{

    public function getordanPalestine()
    {
        $agent =  Content::where('page_id', 19)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.jordan-palestine-egypt-component', [
            'ordanPalestine' => $this->getordanPalestine()
        ]);
    }
}
