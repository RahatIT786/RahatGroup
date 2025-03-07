<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageBrochure;
use App\Models\Boucher;

use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;

class BroucherCreateComponent extends Component
{
    use LivewireAlert,WithFileUploads;
public $name,$image;
    public function save()
    {
        $validated = $this->validate([
            'name' => 'required',
            'image' => 'required|image',
        
            
        ]);
        $validated['is_active'] = $this->status ?? 1;
        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/profile_image', $validated['image'], $imageName);
        $validated['image'] = $imageName;

        Boucher::create($validated);
        $this->alert('success', Lang::get('messages.broucher_save'));
        return to_route('admin.brochure.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-brochure.broucher-create-component');
    }
}
