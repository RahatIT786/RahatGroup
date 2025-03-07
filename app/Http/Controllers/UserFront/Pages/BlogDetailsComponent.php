<?php

namespace App\Http\Controllers\UserFront\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Blogs;

class BlogDetailsComponent extends Component
{

    public $blog, $id;

    public function mount($id)
    {
        // dd($id);
        $this->id = $id;
        $this->blog = Blogs::active()->desc()->where('id', $id)->first();
    }

    public function getBlog()
    {

        // return Blogs::active()->desc()->get();
        return Blogs::active()->desc()->where('id','!=', $this->id)->get();
    }

    #[Layout('user-front.layouts.app')]
    public function render()
    {
        return view('user-front.pages.blog-details-component', [
            'QsBlog' => $this->getBlog()
        ]);
    }
}
