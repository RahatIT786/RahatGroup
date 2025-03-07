<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;

class RewardComponent extends Component
{

    public function getReward()
    {
        $reward =  Content::where('page_id', 4)->with('pagecontent')->first();
        return $reward;
        // $reward =  Content::get();
        // dd($reward);
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.reward-component', [
            'rewards' => $this->getReward()
        ]);
    }
}
