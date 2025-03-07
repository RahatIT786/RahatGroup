<?php

namespace App\Http\Controllers\Admin\ManageSiteSettings\ManageAward;

use App\Models\Award;
use App\Models\AwardImage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AwardCreateComponent extends Component
{
    use WithFileUploads, LivewireAlert;

    public $title, $sub_title, $description, $award_id;
    public $image = [];
    public $imagesPreviewed = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'sub_title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image.*' => 'required',
    ];

    protected $messages = [
        'image.*.required' => 'Image field is required.',
    ];

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
        $this->validate();

        // Create Award entry
        $award = Award::create([
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
        ]);

        foreach ($this->image as $image) {
            $uuid = Str::uuid();
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $image->storeAs('public/award', $imageName);

            AwardImage::create([
                'award_id' => $award->id,
                'image' => $imageName,
            ]);
        }

        $this->alert('success', Lang::get('messages.award_save'));

        return redirect()->route('admin.award.index');
    }

    public function render()
    {
        return view('admin.manage-site-settings.manage-award.award-create-component');
    }
}
