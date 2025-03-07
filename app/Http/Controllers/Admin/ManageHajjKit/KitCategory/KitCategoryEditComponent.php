<?php

namespace App\Http\Controllers\Admin\ManageHajjKit\KitCategory;

use Livewire\Component;
use App\Models\KitCategory;
use App\Models\KitItem;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KitCategoryEditComponent extends Component
{
    public $name, $category_id, $kit_category_img, $price, $description, $id, $category_imgEdit, $itemsError;
    public $serviceType;
    public $kitItem = [];
    public $kit_item_id = [];
    public $totalPrice = 0;
    use LivewireAlert;
    use WithFileUploads;

    public function mount(KitCategory $category)
    {
        // dd(auth()->user());
        $this->id = $category->id;
        $this->name = $category->name;
        $this->category_id = $category->category_id;
        $this->kit_item_id = $category->kit_item_id;
        $this->totalPrice  = $category->price;
        $this->description = $category->description;
        $this->category_imgEdit = $category->kit_category_img;
        $this->kitItem = KitItem::pluck('kit_name', 'id');
        $this->serviceType = ServiceType::pluck('name', 'id');

        // dd($this->totalPrice);
    }

    public function updatedKitItemId($value)
    {
        $this->calculateTotalPrice();
        $this->validateKitItems($this->kit_item_id);
    }

    private function calculateTotalPrice()
    {
        $this->totalPrice = 0;
        if (!empty($this->kit_item_id)) {
            $kitItems = KitItem::whereIn('id', $this->kit_item_id)->get();
            foreach ($kitItems as $item) {
                $this->totalPrice += $item->price;
            }
        }
    }

    public function validateKitItems($selectedItems)
    {
        if (empty($selectedItems) || count($selectedItems) === 0) {
            $this->itemsError = 'Please select atleast one item';
            $this->alert('error', 'Please select atleast one item');
        } else {
            $this->itemsError = '';
        }

        return true; // If validation passes
    }

    public function update()
    {
        $kit = KitCategory::whereId($this->id)->first();
        $validated = $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'kit_item_id' => 'required',
            // 'totalPrice' => 'required|numeric',
            'description' => 'required',
            'kit_category_img' => 'nullable',

        ]);
        $validated['slug'] = Str::slug($this->name);
        $validated['price'] = $this->totalPrice;
        // dd($validated);
        if ($this->kit_category_img) {
            if ($kit->kit_category_img) {
                Storage::delete('public/KitCategory_Image/' . $kit->kit_category_img);
            }
            if (is_string($this->kit_category_img)) {
                $validated['kit_category_img'] = $this->kit_category_img;
            } else {
                $uuid = Str::uuid();
                $imageExtension = $this->kit_category_img->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/KitCategory_Image', $this->kit_category_img, $imageName);
                $validated['kit_category_img'] = $imageName;
            }
        } else {
            $validated['kit_category_img'] = $kit->kit_category_img;
        }
        $validated['kit_item_id'] = implode(',', $validated['kit_item_id']);
        KitCategory::whereId($this->id)->update($validated);
        $this->alert('success', Lang::get('messages.kitt_category_update'));
        return to_route('admin.kitCategory.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-category.kit-category-edit-component');
    }
}
