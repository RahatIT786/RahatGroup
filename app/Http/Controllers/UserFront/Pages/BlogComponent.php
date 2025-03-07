<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Blogs;

class BlogComponent extends Component
{

    public function getBlog()
    {
        // $blog= Blogs::query()->active()->get();
        // //  dd($blog);
        // return $blog;
        return Blogs::active()->desc()->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.blog-component', [
            'QsBlog' => $this->getBlog()
        ]);
    }
}
