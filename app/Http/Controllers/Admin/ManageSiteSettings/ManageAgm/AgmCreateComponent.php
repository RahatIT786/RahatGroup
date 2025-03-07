<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAgm;

use App\Models\Agm;
use App\Models\AgmImage;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AgmCreateComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    public $description, $name, $agm_id;
    public $image = [];
    public $imagesPreviewed = false;


    // Method to check if all images have been previewed
    public function updatedImage()
    {
        $this->imagesPreviewed = true;
        foreach ($this->image as $img) {
            if (!$img->temporaryUrl()) {
                $this->imagesPreviewed = false;
                break;
            }
        }
    }

    public function save()
    {
        // Validation rules
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image.*' => 'required',
        ];

        // Custom error messages
        $customMessages = [
            'name.required' => 'Name field is required.',
            'description.required' => 'Description field is required.',
            'image.*.required' => 'Image field is required.',
            // 'image.*.image' => 'Image field must contain valid image files.',
            // 'image.*.max' => 'Each image must not exceed 1MB in size.',
        ];


        $validatedData = $this->validate($rules, $customMessages);
        // dd($validatedData);
        $agm = Agm::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);
        // dd($agm);

        foreach ($validatedData['image'] as $image) {
            // dd($agm->id);
            $uuid = Str::uuid();
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $image->storeAs('public/agm', $imageName);

            AgmImage::create([
                'agm_id' => $agm->id,
                'image' => $imageName,
            ]);
        }
        $this->alert('success', Lang::get('messages.image_save'));

        return redirect()->route('admin.agm.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-agm.agm-create-component');
    }
}
