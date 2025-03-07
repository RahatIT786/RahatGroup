<?php

namespace App\Http\Controllers\Admin\Services\ManagePublication;

use App\Models\Publication;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicationEditComponent extends Component
{
    public $name, $image, $price, $description, $id, $publication_imgEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(Publication $publication)
    {
        $this->id = $publication->id;
        $this->name = $publication->name;
        $this->price = $publication->price;
        $this->description = $publication->description;
        $this->publication_imgEdit = $publication->image;
    }

    public function update()
    {
        $publication = Publication::whereId($this->id)->first();
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable',

        ]);
        if ($this->image) {
            if ($publication->image) {
                Storage::delete('public/publication_image/' . $publication->image);
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/publication_image', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $publication->image;
        }

        Publication::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.publication_update'));
        return to_route('admin.publication.index');
    }

    public function render()
    {
        return view('admin.services.manage-publication.publication-edit-component');
    }
}
