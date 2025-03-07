<?php

namespace App\Http\Controllers\Admin\ManageTransport\ManageCarRental;

use Livewire\Component;
use App\Models\Cars;
use App\Models\CarSectorMaster;
use App\Models\CarTypeMaster;
use App\Models\CarImage;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CarRentalCreateComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    public $description, $car_sector_id, $car_type_id, $no_of_seats, $air_conditioner, $terms, $price, $car_id;
    public $carsectormaster, $cartypemaster;
    public $image = [];
    public $imagesPreviewed = false;

    public function updatedImage()
    {
        $this->imagesPreviewed = true;
        foreach ($this->image as $img) {
            if (!$img->temporaryUrl()) {
                $this->imagesPreviewed = false;
                break;
            }
        }
    }

    public function mount()
    {
        $this->carsectormaster = CarSectorMaster::pluck('sector_name', 'id');
        $this->cartypemaster = CarTypeMaster::pluck('car_type', 'id');
    }

    public function save()
    {
        // Validation rules
        $rules = [
            'car_sector_id' => 'required',
            'car_type_id' => 'required',
            'no_of_seats' => 'required',
            'air_conditioner' => 'required',
            'terms' => 'required',
            'image.*' => 'required|image|max:2048',
            'image' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ];

        // Custom error messages
        $customMessages = [
            'description.required' => 'Description field is required.',
            'image.required' => 'At least one image is required.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.max' => 'Each image may not be greater than 2MB.',
            'price.required' => 'Price field is required.',
        ];


        $validatedData = $this->validate($rules, $customMessages);
        // dd($validatedData);
        $cars = Cars::create([
            'car_sector_id' => $this->car_sector_id,
            'car_type_id' => $this->car_type_id,
            'no_of_seats' => $this->no_of_seats,
            'air_conditioner' => $this->air_conditioner,
            'terms' => $this->terms,
            'price' => $this->price,
            'description' => $this->description,
        ]);
        // dd($cars);

        foreach ($validatedData['image'] as $image) {
            // dd($cars->id);
            $uuid = Str::uuid();
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;

            $image->storeAs('public/car_image', $imageName);

            CarImage::create([
                'car_id' => $cars->id,
                'image' => $imageName,
            ]);
        }
        $this->alert('success', Lang::get('messages.car_save'));

        return redirect()->route('admin.manageCarRental.index');
    }

    public function render()
    {
        return view('admin.manage-transport.manage-car-rental.car-rental-create-component');
    }
}
