<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAward;

use App\Models\Award;
use App\Models\AwardImage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AwardEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $award_id, $title, $sub_title, $description, $image = [], $imageId, $oldimage, $validatedData;
    protected $listeners = ['confirmDelete'];
    public $imagesPreviewed = true;

    // Mount method to populate fields when component is initialized
    public function mount(Award $award)
    {
        $this->award_id = $award->id;
        $this->title = $award->title;
        $this->sub_title = $award->sub_title;
        $this->description = $award->description;

        $this->oldimage = AwardImage::where('award_id', $this->award_id)->pluck('image', 'id');
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

    // Validation rules and update logic
    public function update()
    {
        // Validate input fields
        $rules = [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        // Custom error messages
        $validationAttributes = [
            'sub_title.required' => 'sub title field is required.',
        ];

        $validated = $this->validate($rules, $validationAttributes);

        // Find Award entry
        $award = Award::find($this->award_id);

        // Update Award entry
        $award->update([
            'title' => $validated['title'],
            'sub_title' => $validated['sub_title'],
            'description' => $validated['description'],
        ]);

        // Update images if any are selected
        if ($this->image) {
            foreach ($this->image as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/award', $photo, $imageName);
                AwardImage::create([
                    'award_id' => $award->id,
                    'image' => $imageName,
                ]);
            }
        }

        $this->alert('success', Lang::get('messages.award_update'));
        return redirect()->route('admin.award.index');
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
        $image = AwardImage::find($this->imageId);
        if ($image) {
            Storage::delete('public/award/' . $image->image);
            $image->delete();
            $this->oldimage = AwardImage::where('award_id', $this->award_id)->pluck('image', 'id')->toArray();
            $this->alert('success', Lang::get('messages.image_deleted'));
        }
    }

    // Render method to display the view
    public function render()
    {
        return view('admin.manage-site-settings.manage-award.award-edit-component');
    }
}
