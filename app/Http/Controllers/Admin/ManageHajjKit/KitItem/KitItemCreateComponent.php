<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\KitItem;

use Livewire\Component;
use App\Models\KitItem;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KitItemCreateComponent extends Component
{
    public $kit_name, $kit_img, $price;
    use LivewireAlert;
    use WithFileUploads;
    public function save()
    {
        // dd(auth()->user());
        // dd("hi");
        $validated = $this->validate([
            'kit_name' => 'required',
            'price' => 'required|numeric',
            'kit_img' => 'required|image|max:1024',
        ]);
        $validated['is_active'] = $this->status ?? 1;
        // $validated['slug'] = Str::slug($this->name);

        $uuid = Str::uuid();
        $imageExtension = $validated['kit_img']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/kit_image', $validated['kit_img'], $imageName);
        $validated['kit_img'] = $imageName;
        // dd($validated);
        KitItem::create($validated);
        $this->alert('success', Lang::get('messages.kitt_item_save'));
        return to_route('admin.kitItem.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-item.kit-item-create-component');
    }
}
