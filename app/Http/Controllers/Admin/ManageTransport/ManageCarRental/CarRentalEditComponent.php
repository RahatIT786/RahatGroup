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

class CarRentalEditComponent extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    protected $listeners = ['confirmDelete'];
    public $description, $car_sector_id, $car_type_id, $no_of_seats, $air_conditioner, $terms, $price, $car_id, $oldimage;
    public $carsectormaster, $cartypemaster, $imageId;
    public $image = [];
    public $imagesPreviewed = false;

    public function mount(Cars $cars)
    {
        // dd($Cars);
        $this->car_id = $cars->id;
        $this->car_sector_id = $cars->car_sector_id;
        $this->car_type_id = $cars->car_type_id;
        $this->no_of_seats = $cars->no_of_seats;
        $this->air_conditioner = $cars->air_conditioner;
        $this->terms = $cars->terms;
        $this->terms = $cars->terms;
        $this->description = $cars->description;
        $this->price = $cars->price;
        $this->oldimage = CarImage::where('car_id', $this->car_id)->pluck('image', 'id');
        $this->carsectormaster = CarSectorMaster::pluck('sector_name', 'id');
        $this->cartypemaster = CarTypeMaster::pluck('car_type', 'id');
    }

    public function uploadingImage()
    {
        $this->imagesPreviewed = false;
        // dd($this->imagesPreviewed);
    }

    public function updatedImage()
    {
        if (count($this->image) > 0) {
            $this->imagesPreviewed = true;
            foreach ($this->image as $img) {
                if (!$img->temporaryUrl()) {
                    $this->imagesPreviewed = false;
                    break;
                }
            }
        }
    }

    public function update()
    {
        $rules = [
            'car_sector_id' => 'required',
            'car_type_id' => 'required',
            'no_of_seats' => 'required',
            'air_conditioner' => 'required',
            'terms' => 'required',
            'image.*' => 'image|max:2048',
            'image' => 'nullable',
            'price' => 'required|numeric',
            'description' => 'required',
        ];
        $validationAttributes = [
            'description.required' => 'Description field is required.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.max' => 'Each image may not be greater than 2MB.',
            'price.required' => 'Price field is required.',
        ];
        // dd($validated);
        $validated = $this->validate($rules, $validationAttributes);

        $cars = Cars::find($this->car_id);
        $cars->update([
            'car_sector_id' => $validated['car_sector_id'],
            'car_type_id' => $validated['car_type_id'],
            'no_of_seats' => $validated['no_of_seats'],
            'air_conditioner' => $validated['air_conditioner'],
            'terms' => $validated['terms'],
            'price' => $validated['price'],
            'description' => $validated['description'],
        ]);
        // dd($this->image);
        if ($this->image) {
            //DELETE OLD IMAGES
            foreach ($this->image as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                Storage::putFileAs('public/car_image', $photo, $imageName);
                CarImage::create([
                    'car_id' => $cars->id,
                    'image' => $imageName,
                ]);
            }
        }
        $this->alert('success', Lang::get('messages.car_update'));
        return redirect()->route('admin.manageCarRental.index');
    }

    public function deleteImage($imageId)
    {
        $this->imageId = $imageId;
        $this->confirm('Are you sure to delete this?', [
            'icon' => 'question',
            'confirmButtonText' => 'Yes',
            'onConfirmed' => 'confirmDelete',
        ]);
    }

    public function confirmDelete()
    {
        $image = CarImage::find($this->imageId);
        if ($image) {
            Storage::delete('public/car_image/' . $image->image);
            $image->delete();
            $this->oldimage = CarImage::where('car_id', $this->car_id)->pluck('image', 'id')->toArray();
            $this->alert('success', Lang::get('messages.car_image_deleted'));
        }
    }

    public function render()
    {
        return view('admin.manage-transport.manage-car-rental.car-rental-edit-component');
    }
}
