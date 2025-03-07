<?php

namespace App\Http\Controllers\Admin\Services\ManageService;

use Livewire\Component;
use App\Models\Services;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ServicesCreateComponent extends Component
{
    public $name, $service_img, $price, $description;
    use LivewireAlert;
    use WithFileUploads;

    public function save()
    {
        // dd(auth()->user());
        // dd("hi");
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'service_img' => 'required|image|max:1024',
        ]);
        $validated['slug'] = Str::slug($this->name);

        $uuid = Str::uuid();
        $imageExtension = $validated['service_img']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/service_image', $validated['service_img'], $imageName);
        $validated['service_img'] = $imageName;
        // dd($validated);
        Services::create($validated);
        $this->alert('success', Lang::get('messages.service_save'));
        return to_route('admin.services.index');
    }



    public function render()
    {
        return view('admin.services.manage-service.services-create-component');
    }
}
