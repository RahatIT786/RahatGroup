<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use App\Models\Agent\Content;
use Livewire\Attributes\Layout;

class RewardListComponent extends Component
{

    public function getReward()
    {
        $reward =  Content::where('page_id', 4)->with('pagecontent')->first();
        return $reward;
        // $reward =  Content::get();
        // dd($reward);
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.reward-list-component', [
            'rewards' => $this->getReward()
        ]);
    }
}
