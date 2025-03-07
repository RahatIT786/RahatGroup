<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog;

use App\Models\Blogs;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogCreateComponent extends Component
{
    public $title, $subtitle, $description, $image;
    use LivewireAlert;
    use WithFileUploads;

    public function save() 
    {
        $validated = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:1024',
        ]);

        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/blog_image', $validated['image'], $imageName);
        $validated['image'] = $imageName;
        
        Blogs::create($validated);
        $this->alert('success', Lang::get('messages.blog_save'));
        return to_route ('admin.blog.index'); 
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-blog.blog-create-component');
    }
}
