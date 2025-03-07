<?php

namespace App\Http\Controllers\Admin\PackageManagement\FoodType;

use App\Models\FoodMaster;
use App\Models\FoodImage;
use App\Models\PackageType;

use Illuminate\Support\Facades\Lang;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class FoodTypeCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $food_type, $price, $description, $food_id, $lunch, $dinner, $packagetype;
    public $image = [];
    public $l_image = [];
    public $d_image = [];
    public $f_pdf;
    public function rules()
    {
        // Validation rules
        return [
            'food_type' => 'required',
            'price' => 'required',
            'description' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
            'image.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'l_image.*' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'd_image.*'  => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function messages()
    {
        // Custom error messages
        return [
            'food_type.required' => 'Food type field is required.',
            'description.required' => 'Description field is required.',
            'lunch.required' => 'Lunch field is required.',
            'dinner.required' => 'Dinner field is required.',
            'price.required' => 'Price field is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price must be at least 0.',
            'image.*.required' => 'Image field is required.',
            'image.*.max' => 'Each image must not exceed 2MB in size.',
            'l_image.*.required' => 'Image field is required.',
            'd_image.*.required' => 'Image field is required.',
        ];
    }

    public function save()
    {
        $validatedData = $this->validate();
       
        if($this->f_pdf){
            $uuid = Str::uuid();
            $fileExtension = $this->f_pdf->getClientOriginalExtension();
            $fileName = $uuid . '.' . $fileExtension;
            $this->f_pdf->storeAs('public/food_pdf', $fileName);
        }else{
            $fileName = '';    
        }
        
        
        $food = FoodMaster::create([
            'food_type' => $this->food_type,
            'price' => $this->price,
            'description' => $this->description,
            'lunch' => $this->lunch,
            'dinner' => $this->dinner,
            'food_pdf' => $fileName 

        ]);

                foreach ($validatedData['image'] as $file) {
                    
                    $uuid = Str::uuid();
                    $fileExtension = $file->getClientOriginalExtension();
                    $fileName = $uuid . '.' . $fileExtension;

                    // Store both image and PDF files in the same directory 'food_images'
                    $file->storeAs('public/food_image', $fileName);

                    // Store in the database with the same food_type (1)
                    FoodImage::create([
                        'food_id' => $food->id,
                        'food_type' => 1, // Food type 1 for both images and PDFs
                        'image' => $fileName,
                    ]);
                }

                foreach ($validatedData['d_image'] as $d_file) {
                    // dd($food->id);
                    $uuid = Str::uuid();
                    $imageExtension = $file->getClientOriginalExtension();
                    $imageName = $uuid . '.' . $imageExtension;

                    $d_file->storeAs('public/food_image', $imageName);

                    FoodImage::create([
                        'food_id' => $food->id,
                        'food_type' => 3,
                        'image' => $imageName,
                    ]);
                }

                foreach ($validatedData['l_image'] as $l_file) {
                     // dd($food->id);
                     $uuid = Str::uuid();
                     $imageExtension = $file->getClientOriginalExtension();
                     $imageName = $uuid . '.' . $imageExtension;

                     $l_file->storeAs('public/food_image', $imageName);

                    FoodImage::create([
                        'food_id' => $food->id,
                       'food_type' => 2,
                        'image' => $imageName,
                    ]);
                 }

                // foreach ($validatedData['l_image'] as $l_file) {
                //     $uuid = Str::uuid();
                //     $fileExtension = $l_file->getClientOriginalExtension();
                //     $fileName = $uuid . '.' . $fileExtension;

                //     if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                //         $filePath = $l_file->storeAs('public/food_image', $fileName);
                //         $fileType = 2; // Example: 2 for lunch images
                //     } elseif ($fileExtension === 'pdf') {
                //         $filePath = $l_file->storeAs('public/food_image', $fileName);
                //         $fileType = 4; // Example: 4 for lunch PDFs
                //     } else {
                //         continue; // Skip unsupported files
                //     }
                //     FoodImage::create([
                //         'food_id' => $food->id,
                //        'food_type' => 2,
                //         'image' => $imageName,
                //     ]);
                //  }


        $this->alert('success', Lang::get('messages.foodtype_create'));

        return redirect()->route('admin.foodType.index');

        // $validated = $this->validate([
        //     'food_type' => 'required',
        //     'price' => 'required',
        //     'description' => 'required',

        // ]);
        // $validated['is_active'] = $this->status ?? 1;
        // FoodMaster::create($validated);
        // $this->alert('success', Lang::get('messages.foodtype_create'));
        // return to_route('admin.foodType.index');
    }

    public function render()
    {
        return view('admin.package-management.food-type.food-type-create-component');
    }
}
