<?php

namespace App\Http\Controllers\Agent\Settings\Banner;

use Livewire\Attributes\Layout;
use App\Models\Agent\ManageBanner;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerEditComponent extends Component
{
    public $banner_title, $banner_img, $id, $status, $banner_imgEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(ManageBanner $manageBanner)
    {
        // dd(auth()->user());
        $this->id = $manageBanner->id;
        $this->banner_title = $manageBanner->banner_title;
        $this->banner_imgEdit = $manageBanner->banner_img;
        $this->status = $manageBanner->is_active;
    }

    public function update()
    {
        $manageBanner = ManageBanner::whereId($this->id)->first();
        $validated = $this->validate([
            'banner_title' => 'required',
        ]);
        $validated['agent_id']  = auth()->user()->id;

        if ($this->banner_img) {
            if ($manageBanner->banner_img) {
                Storage::delete('public/banner_image/' . $manageBanner->banner_img);
            }
            if (is_string($this->banner_img)) {
                $validated['banner_img'] = $this->banner_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->banner_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/banner_image', $this->banner_img, $imageName);
                $validated['banner_img'] = $imageName;
            }
        } else {
            $validated['banner_img'] = $manageBanner->banner_img;
        }

        ManageBanner::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.banner_update'));
        return to_route ('agent.banner.index'); 
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.settings.banner.banner-edit-component');
    }
}
