<?php

namespace App\Http\Controllers\Admin\Services\ManageService;

use Livewire\Component;
use App\Models\Services;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServicesEditComponent extends Component
{
    public $name, $service_img, $price, $description, $id, $service_imgEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(Services $service)
    {
        // dd(auth()->user());
        $this->id = $service->id;
        $this->name = $service->name;
        $this->price = $service->price;
        $this->description = $service->description;
        $this->service_imgEdit = $service->service_img;
    }

    public function update()
    {
        $service = Services::whereId($this->id)->first();
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'service_img' => 'nullable',

        ]);
        $validated['slug'] = Str::slug($this->name);
        // dd($validated);
        if ($this->service_img) {
            if ($service->service_img) {
                Storage::delete('public/service_image/' . $service->service_img);
            }
            if (is_string($this->service_img)) {
                $validated['service_img'] = $this->service_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->service_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/service_image', $this->service_img, $imageName);
                $validated['service_img'] = $imageName;
            }
        } else {
            $validated['service_img'] = $service->service_img;
        }

        Services::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.service_update'));
        return to_route('admin.services.index');
    }

    public function render()
    {
        return view('admin.services.manage-service.services-edit-component');
    }
}
