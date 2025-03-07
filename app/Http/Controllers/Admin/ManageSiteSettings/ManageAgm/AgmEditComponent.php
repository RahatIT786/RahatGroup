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

class AgmEditComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    public $description, $oldimage, $name, $agm_id, $imageId;
    protected $listeners = ['confirmDelete'];
    public $image = [];
    public $imagesPreviewed = true;

    public function mount(Agm $agms)
    {
        // dd($agms);
        $this->agm_id = $agms->id;
        $this->name = $agms->name;
        $this->description = $agms->description;
        $this->oldimage = AgmImage::where('agm_id', $this->agm_id)->pluck('image', 'id');
    }

    public function uploadingImage()
    {
        $this->imagesPreviewed = false;
        // dd($this->imagesPreviewed);
    }

    public function updatedImage()
    {
        if (count($this->image) > 0) {
            $this->imagesPreviewed = true;
            foreach ($this->image as $img) {
                if (!$img->temporaryUrl()) {
                    $this->imagesPreviewed = false;
                    break;
                }
            }
        }
    }

    public function update()
    {
        // dd($this->name,$this->description,$this->image);
        $rules = [
            'name' => 'required',
            'description' => 'required',
            // 'image.*' => 'nullable|image|max:1024',
        ];
        $validationAttributes = [
            'name.required' => 'Name field is required.',
            'description.required' => 'Description field is required.',
            'image.*.required' => 'Image field is required.',
            // 'image.*.image' => 'Image field must contain valid image files.',
            // 'image.*.max' => 'Each image must not exceed 1MB in size.',
        ];
        // dd($validated);
        $validated = $this->validate($rules, $validationAttributes);

        $agm = Agm::find($this->agm_id);
        $agm->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        // dd($this->image);
        if ($this->image) {
            //DELETE OLD IMAGES
            foreach ($this->image as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/agm', $photo, $imageName);
                AgmImage::create([
                    'agm_id' => $agm->id,
                    'image' => $imageName,
                ]);
            }
        }
        $this->alert('success', Lang::get('messages.agm_update'));
        return redirect()->route('admin.agm.index');
    }


    public function deleteImage($imageId)
    {
        $this->imageId = $imageId;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $image = AgmImage::find($this->imageId);
        if ($image) {
            Storage::delete('public/agm/' . $image->image);
            $image->delete();
            $this->oldimage = AgmImage::where('agm_id', $this->agm_id)->pluck('image', 'id')->toArray();
            $this->alert('success', Lang::get('messages.image_deleted'));
        }
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-agm.agm-edit-component');
    }
}
