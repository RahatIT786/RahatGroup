<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBlog;

use Livewire\Component;
use App\Models\Blogs;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;

class BlogListComponent extends Component
{
    use WithPagination, LivewireAlert;
    public $perPage = 10, $title, $search_blog_title, $blogId = null;
    protected $listeners = ['confirmed', 'confirmDelete'];

    public function getManageBlog()
    {
        return Blogs::query()
            ->searchLike('title', $this->search_blog_title)
            ->desc()
            ->paginate($this->perPage);
    }

    public function toggleStatus(Blogs $blogs)
    {
        // dd($blogs);
        $this->blogId = $blogs->id;
        $this->confirm('Are you sure to change status?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmed',
        ]);
    }
    public function confirmed()
    {
        // dd($this->blogId);
        $blogData = Blogs::whereId($this->blogId);
        // dd($blogData);
        $blogData->update(['is_active' => !$blogData->first()->is_active]);
        $this->alert('success', Lang::get('messages.blog_status_changed'));
    }

    public function isDelete(Blogs $blogs)
    {
        // dd($blogs);
        $this->blogId = $blogs->id;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }
    public function confirmDelete()
    {
        $blogData = Blogs::whereId($this->blogId);
        //   dd($blogData);
        $blogData->delete();
        $this->alert('success', Lang::get('messages.blog_delete'));
    }

    public function filterBlogTitle()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-blog.blog-list-component', [
            'manageBlogs' => $this->getManageBlog(),
        ]);
    }
}
