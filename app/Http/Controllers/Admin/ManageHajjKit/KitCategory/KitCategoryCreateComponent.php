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


class KitCategoryCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    public $name, $category_id, $kit_category_img, $price, $description, $itemsError;
    public $serviceType;
    public $kitItem = [];
    public $kit_item_id = [];
    public $totalPrice = 0;

    public function mount()
    {
        $this->kitItem = KitItem::pluck('kit_name', 'id');
        $this->serviceType = ServiceType::pluck('name', 'id');
    }

    public function updatedKitItemId($value)
    {
        $this->calculateTotalPrice();
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

    public function save()
    {
        // dd(auth()->user());
        // dd("hi");
        $validated = $this->validate([
            'name' => 'required',
            'category_id' => 'required',
            'kit_item_id' => 'required|array|min:1',
            'totalPrice' => 'required|numeric',
            'description' => 'required',
            'kit_category_img' => 'required|image|max:1024',
        ]);
        // dd($this->kit_item_id); s
        $validated['slug'] = Str::slug($this->name);
        $validated['price'] = $this->totalPrice;


        $uuid = Str::uuid();
        $imageExtension = $validated['kit_category_img']->getClientOriginalExtension();
        $imageName = $uuid . '.' . $imageExtension;
        Storage::putFileAs('public/KitCategory_Image', $validated['kit_category_img'], $imageName);
        $validated['kit_category_img'] = $imageName;
        // Convert array of IDs to a comma-separated string
        $validated['kit_item_id'] = implode(',', $validated['kit_item_id']);

        KitCategory::create($validated);
        // dd($validated);
        $this->alert('success', Lang::get('messages.kitt_category_save'));
        return to_route('admin.kitCategory.index');
    }

    public function render()
    {
        return view('admin.manage-hajj-kit.kit-category.kit-category-create-component');
    }
}
