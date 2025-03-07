<?php

namespace App\Http\Controllers\Admin\PackageManagement\FoodType;

use App\Models\FoodMaster;
use App\Models\FoodImage;
use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FoodTypeEditComponent extends Component
{
    public $id, $food_type, $price, $description, $oldimage, $food_id, $imageId, $status,$lunch,$dinner,$packagetype,$regularImage,$lunchImage,$dinnerImage;
    public $images = [];
    public $l_images = [];
    public $d_images = [];
    public $f_pdf;

    protected $listeners = ['confirmed', 'confirmDelete','imageDeleted' => '$refresh'];

    use LivewireAlert, WithFileUploads;

    public function mount(FoodMaster $foodMaster)
    {   
        $this->id = $foodMaster->id;
        $this->food_type = $foodMaster->food_type;
        $this->price = $foodMaster->price;
        $this->description = $foodMaster->description;
        $this->lunch = $foodMaster->lunch;
        $this->dinner = $foodMaster->dinner;
        $this->f_pdf = $foodMaster->food_pdf;
        
        // Fetch images and group by food type
        $this->oldimage = FoodImage::where('food_id', $this->id)->get();
        //  dd($this->oldimage);
        // Separate images by food type
        $this->regularImage = $this->oldimage->where('food_type', 1); // Type 1 = Regular image
        $this->lunchImage = $this->oldimage->where('food_type', 2); // Type 2 = Lunch image
        $this->dinnerImage = $this->oldimage->where('food_type', 3); // Type 3 = Dinner image

        $this->status = $foodMaster->is_active;
    }

    public function rules()
    {
        return [
            'food_type' => 'required',
            'price' => 'required',
            'description' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
            'images.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // Accept multiple regular food images
            'l_images.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',  // Accept multiple lunch images
            'd_images.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',  // Accept multiple dinner images
        ];
    }
    public function messages()
    {
        // Custom error messages
        return [
            'food_type.required' => 'food_type field is required.',
            'description.required' => 'Description field is required.',
            'lunch.required' => 'Lunch field is required.',
            'dinner.required' => 'Dinner field is required.',
        ];
    }

    public function update()
    {
        
        // Validate the inputs
        $validated = $this->validate();

        // Find the food item by ID
        $food = FoodMaster::find($this->id);

        if (!$food) {
            $this->alert('error', 'Food item not found.');
            return;
        }

        if($this->f_pdf){
            $uuid = Str::uuid();
            $fileExtension = $this->f_pdf->getClientOriginalExtension();
            $fileName = $uuid . '.' . $fileExtension;
            $this->f_pdf->storeAs('public/food_pdf', $fileName);
        }else{
            $fileName = '';    
        }
        

        // Update the food item (excluding images)
        $food->update([
            'food_type' => $validated['food_type'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'lunch' => $validated['lunch'],
            'dinner' => $validated['dinner'],
            'food_pdf' => $fileName 
        ]);

        // Function to handle multiple image uploads and replacements
         $uploadImages = function ($images, $type) use ($food) {
            
            foreach ($images as $image) {
                
                if ($image) {
                    // Generate a unique name for the image
                    $uuid = Str::uuid();
                    $imageExtension = $image->getClientOriginalExtension();
                    $imageName = $uuid . '.' . $imageExtension;
                   
                    // Store the image
                    Storage::putFileAs('public/food_image', $image, $imageName);

                    // Remove any existing image of the same type (delete old image)
                    // FoodImage::where('food_id', $food->id)
                    //     ->where('food_type', $type)
                    //     ->delete(); // This will delete the old images before storing the new ones

                    // Save the new images in the FoodImage model
                    FoodImage::create([
                        'food_id' => $food->id,
                        'food_type' => $type,
                        'image' => $imageName,
                    ]);
                }
            }
            
        };

        // Upload images for each type if present
        if (count($this->images)) {
            $uploadImages($this->images, 1); // Type 1 for regular food images
        }

        if (count($this->l_images)) {
            $uploadImages($this->l_images, 2); // Type 2 for lunch images
        }

        if (count($this->d_images)) {
            $uploadImages($this->d_images, 3); // Type 3 for dinner images
        }

        // Success alert and redirect
        $this->alert('success', 'Food item updated successfully!');
        return redirect()->route('admin.foodType.index');
    }
    public function deleteImage($imageId)
    {
        $currentImage = FoodImage::find($imageId);
        if ($currentImage) {
            Storage::delete('public/food_image/' . $currentImage->image);
            $currentImage->delete();
            $this->oldimage = FoodImage::where('food_id', $currentImage->food_id)->get();
            $this->regularImage = $this->oldimage->where('food_type', 1); // Type 1 = Regular image
            $this->lunchImage = $this->oldimage->where('food_type', 2); // Type 2 = Lunch image
            $this->dinnerImage = $this->oldimage->where('food_type', 3);
            $this->alert('success', Lang::get('messages.image_deleted'));
           
        } else {
            // If the image doesn't exist, alert the user
            // $this->alert('error', 'Image not found.');
        }
    }
    public function deletePdf(FoodMaster $foodMaster)
    {
        if ($foodMaster->food_pdf) {
            Storage::delete('public/food_pdf/' . $foodMaster->food_pdf);
            $foodMaster->update([  'food_pdf' =>'']);
            $new_foodMaster = FoodMaster::find($foodMaster->id);
            $this->f_pdf =  $new_foodMaster->food_pdf;
            $this->alert('success', Lang::get('messages.image_deleted'));
        }
    }

    public function render()
    {
        return view('admin.package-management.food-type.food-type-edit-component');
    }
}
