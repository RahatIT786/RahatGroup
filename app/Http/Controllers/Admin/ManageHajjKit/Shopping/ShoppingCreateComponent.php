<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\Shopping;

use Livewire\Component;
use App\Models\Shopping;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;


class ShoppingCreateComponent extends Component
{
    public $shp_name, $price, $description, $image;
    use LivewireAlert;
    use WithFileUploads;

    public function save()
    {
        $validated = $this->validate([
            'shp_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:1024',

        ]);

        $uuid = Str::uuid();
        $imageExtension = $validated['image']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/shopping_image', $validated['image'], $imageName);
        $validated['image'] = $imageName;

        Shopping::create($validated);
        $this->alert('success', Lang::get('messages.shopping_save'));
        return to_route ('admin.shopping.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.shopping.shopping-create-component');
    }
}
