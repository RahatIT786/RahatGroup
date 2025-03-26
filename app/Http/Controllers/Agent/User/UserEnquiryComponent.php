<?php

namespace App\Http\Controllers\Agent\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Category;
use App\Models\UserEnquiryForAgent;

class UserEnquiryComponent extends Component
{
    public $categories, $pages, $title, $contain, $pageData, $category_id = 6, $page_id, $user_enquiries, $agent;
    public function mount(){
        // $pageData = Category::whereId(6)->first();
        // $this->categories = Category::active()->with('pages')->get();
        // $this->title = $pageData->cate_name;
        // $this->contain = $pageData->description;
        $this->agent = auth('agent')->user();
        $this->user_enquiries = UserEnquiryForAgent::where('delete_status', '1')
                                                    ->where('agent_id', $this->agent->id)
                                                    ->get();

    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.user.user-enquiry-component');
    }
}
