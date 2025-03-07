<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBanner;

use App\Models\Agent\ManageBanner;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerCreateComponent extends Component
{

    public $banner_title, $banner_img;
    use LivewireAlert;
    use WithFileUploads;

    public function save() 
    {
        // dd(auth()->user());
        // dd("hi");
        $validated = $this->validate([
            'banner_title' => 'required',
            'banner_img' => 'required|image|max:1024',
        ]);
        $validated['is_active'] = $this->status ?? 1;
       
        $uuid = Str::uuid();
        $imageExtension = $validated['banner_img']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/banner_image', $validated['banner_img'], $imageName);
        $validated['banner_img'] = $imageName;

        ManageBanner::create($validated);
        $this->alert('success', Lang::get('messages.banner_save'));
        return to_route ('admin.banner.index'); 
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-banner.banner-create-component');
    }
}
