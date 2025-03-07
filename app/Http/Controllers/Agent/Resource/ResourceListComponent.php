<?php

namespace App\Http\Controllers\Agent\Resource;

use App\Models\Agent\Category;
use App\Models\Agent\Page;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ResourceListComponent extends Component
{
    public $categories, $pages, $title, $contain, $pageData, $category_id = 6, $page_id;

    public function mount()
    {
        $pageData = Category::whereId(6)->first();
        $this->categories = Category::active()->with('pages')->get();
        $this->title = $pageData->cate_name;
        $this->contain = $pageData->description;
    }

    public function viewContent(Page $page)
    {
        $this->page_id = $page->id;
        $pageData = Page::active()->whereId($page->id)->first();
        $this->title = $pageData->page_title;
        $this->contain = $pageData->page_contain;
    }

    public function viewCategoryContent(Category $category)
    {
        $this->page_id = $category->id;
        $pageData = Category::whereId($category->id)->first();
        $this->title = $pageData->cate_name;
        $this->contain = $pageData->description;
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.resource.resource-list-component');
    }
}
