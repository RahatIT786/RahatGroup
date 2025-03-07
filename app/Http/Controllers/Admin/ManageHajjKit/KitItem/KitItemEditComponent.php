<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\KitItem;

use Livewire\Component;
use App\Models\KitItem;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KitItemEditComponent extends Component
{
    public $kit_name, $kit_img, $price, $id, $kit_imgEdit;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(KitItem $kititems)
    {
        // dd(auth()->user());
        $this->id = $kititems->id;
        $this->kit_name = $kititems->kit_name;
        $this->price = $kititems->price;
        $this->kit_imgEdit = $kititems->kit_img;
        // $this->status = $kititems->is_active;
    }

    public function update()
    {
        $items = KitItem::whereId($this->id)->first();
        $validated = $this->validate([
            'kit_name' => 'required',
            'price' => 'required|numeric',
            'kit_img' => 'nullable',

        ]);
        // $validated['slug'] = Str::slug($this->name);
        // dd($validated);
        if ($this->kit_img) {
            if ($items->kit_img) {
                Storage::delete('public/kit_image/' . $items->kit_img);
            }
            if (is_string($this->kit_img)) {
                $validated['kit_img'] = $this->kit_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->kit_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/kit_image', $this->kit_img, $imageName);
                $validated['kit_img'] = $imageName;
            }
        } else {
            $validated['kit_img'] = $items->kit_img;
        }
        KitItem::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.kitt_item_update'));
        return to_route('admin.kitItem.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-item.kit-item-edit-component');
    }
}
