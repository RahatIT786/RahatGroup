<?php

namespace App\Http\Controllers\Admin\Services\ManagePublication;

use App\Models\Publication;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicationCreateComponent extends Component
{
    public $name, $image, $price, $description;
    use LivewireAlert;
    use WithFileUploads;

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|max:1024',
        ]);

        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/publication_image', $validated['image'], $imageName);
        $validated['image'] = $imageName;
        $validated['is_active'] = $this->status ?? 1;
        Publication::create($validated);
        $this->alert('success', Lang::get('messages.publication_save'));
        return to_route('admin.publication.index');
    }

    public function render()
    {
        return view('admin.services.manage-publication.publication-create-component');
    }
}
