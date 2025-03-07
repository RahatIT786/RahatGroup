<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog;

use App\Models\Blogs;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogEditComponent extends Component
{
    public $title, $subtitle, $description, $image, $id, $status, $imageEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(Blogs $manageBlog)
    {
        $this->id = $manageBlog->id;
        $this->title = $manageBlog->title;
        $this->subtitle = $manageBlog->subtitle;
        $this->description = $manageBlog->description;
        $this->imageEdit = $manageBlog->image;
    }

    public function update()
    {
        $manageBlog = Blogs::findOrFail($this->id); 
        $validated = $this->validate([
            'title' => 'required', 
            'subtitle' => 'required', 
            'description' => 'required', 
        ]);
    
        if ($this->image) {
            if ($manageBlog->image) {
                Storage::delete('public/blog_image/' . $manageBlog->image); 
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image; 
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/blog_image', $this->image, $imageName); 
                $validated['image'] = $imageName; 
            }
        } else {
            $validated['image'] = $manageBlog->image; 
        }
    
        $manageBlog->update($validated); 
        $this->alert('success', Lang::get('messages.blog_update'));
        return redirect()->route('admin.blog.index'); 
    }
    

    public function render()
    {
        return view('admin.manage-site-settings.manage-blog.blog-edit-component');
    }
}
