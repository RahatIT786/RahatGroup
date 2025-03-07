<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\Shopping;

use Livewire\Component;
use App\Models\Shopping;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;

class ShoppingEditComponent extends Component
{
    public $shp_name, $price, $description, $image, $id, $status, $imageEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(Shopping $shopping)
    {
        $this->id = $shopping->id;
        $this->shp_name = $shopping->shp_name;
        $this->price = $shopping->price;
        $this->description = $shopping->description;
        $this->imageEdit = $shopping->image;
    }

    public function update()
    {
        $shopping = Shopping::findOrFail($this->id);
        $validated = $this->validate([
            'shp_name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if ($this->image) {
            if ($shopping->image) {
                Storage::delete('public/shopping_image/' . $shopping->image);
            }
            if (is_string($this->image)) {
                $validated['image'] = $this->image;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->image->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/shopping_image', $this->image, $imageName);
                $validated['image'] = $imageName;
            }
        } else {
            $validated['image'] = $shopping->image;
        }

        $shopping->update($validated);
        $this->alert('success', Lang::get('messages.shopping_update'));
        return redirect()->route('admin.shopping.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.shopping.shopping-edit-component');
    }
}
