<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm;

use Livewire\Component;
use App\Models\Admin\Agm;
use App\Models\Admin\AgmImage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AgmImageComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $agm_id;
    public $image = [];

    public function save()
    {
        // Validation rules
        $rules = [
            'image.*' => 'required|image|max:2048', 
        ];

        // Custom error messages
        $customMessages = [
            'image.*.image' => 'Image field must contain valid image files.',
            'image.*.max' => 'Each image must not exceed 2MB in size.',
        ];

        $validatedData = $this->validate($rules, $customMessages);

        foreach ($validatedData['image'] as $image) {

            $uuid = Str::uuid();
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $image->storeAs('public/agm', $imageName);

            AgmImage::create([
                'agm_id' => $this->agm_id,
                'image' => $imageName,
            ]);
        }

        $this->alert('success', Lang::get('messages.image_gallery_save'));

        return redirect()->route('admin.agm.image');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-agm.agm-image-component');
    }
}
