<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Content;
use App\Models\Agent\PageContent;

class ChildRefundPolicyComponent extends Component
{

    public function getChildRefund()
    {
        $agent =  Content::where('page_id', 16)->with('pagecontent')->first();
        // dd($agent);
        return $agent;
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.child-refund-policy-component', [
            'childRefund' => $this->getChildRefund()
        ]);
    }
}
