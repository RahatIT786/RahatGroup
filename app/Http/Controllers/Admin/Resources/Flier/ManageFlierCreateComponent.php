<?php

namespace App\Http\Controllers\Admin\Resources\Flier;

use App\Models\Flier;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageFlierCreateComponent extends Component
{
    public $flier_code, $service, $image, $comments, $service_name;
    use LivewireAlert, WithFileUploads;
    public function save()
    {
        // dd($this->flier_code);
        $validated = $this->validate([
            'flier_code' => 'required',
            'service_name' => 'required',
            'image' => 'required|image|max:1024',
            'comments' => 'required',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;

        // Store the profile image in the storage/app/public directory
        Storage::putFileAs('public/fliers', $validated['image'], $imageName);

        $validated['image'] = $imageName;

        Flier::create($validated);
        $this->alert('success', Lang::get('messages.flier_save'));
        return to_route('admin.manageFlier.index');
    }
    public function render()
    {
        return view('admin.resources.flier.manage-flier-create-component');
    }
}
