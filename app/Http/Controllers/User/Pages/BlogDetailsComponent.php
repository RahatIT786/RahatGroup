<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Blogs;

class BlogDetailsComponent extends Component
{
    public $blog, $id;
    // public function getBlogDetails()
    // {   
    //     $blogDetails= Blogs::query()->active()->first();  
    //     //  dd($blogDetails);
    //     return $blogDetails;
    // }

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


    #[Layout('user.layouts.app')]
    public function render()
    {
        // dd($this->getBlog());
        return view('user.pages.blog-details-component', [
            'QsBlog' => $this->getBlog()
        ]);
    }
}
