<?php

namespace App\Http\Controllers\Agent\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Agent\Category;

class UserEnquiryComponent extends Component
{
    public $categories, $pages, $title, $contain, $pageData, $category_id = 6, $page_id;
    public function mount(){
        $pageData = Category::whereId(6)->first();
        $this->categories = Category::active()->with('pages')->get();
        $this->title = $pageData->cate_name;
        $this->contain = $pageData->description;
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.user.user-enquiry-component');
    }
}
