<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Models\City;
use App\Models\FlightMaster;
use App\Models\FoodMaster;
use App\Models\HotelMaster;
use App\Models\LaundryMaster;
use App\Models\PackageMaster;
use App\Models\PackageType;
use App\Models\TransportMaster;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class PackageEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $packageType, $makaHotel, $madinaHotel, $foodMaster, $transportMaster, $lundrayMaster, $cityMaster, $flightMaster;
    public $package_name, $package_type, $service_id, $makka_rating, $makka_hotel, $madina_rating, $madina_hotel, $food_type, $transport_type, $laundray_type, $dept_city_id, $flight_id, $g_share_price, $qt_share_price, $qd_share_price, $t_share_price, $d_share_price, $single_price, $child_w_b, $child_wo_b, $infants, $zamzam, $ziyarat, $package_image, $description, $moullim_no, $stay_id;

    public $package_includes = [];

    public $id;


    public function mount(PackageMaster $packagemaster)
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->foodMaster = FoodMaster::pluck('food_type', 'id');
        $this->transportMaster = TransportMaster::pluck('transport_type', 'id');
        $this->lundrayMaster = LaundryMaster::pluck('lundray_type', 'id');
        $this->cityMaster = City::pluck('city_name', 'id');
        $this->flightMaster = FlightMaster::pluck('flight_name', 'id');

        $this->id = $packagemaster->id;
        $this->package_name = $packagemaster->package_name;
        $this->package_type = $packagemaster->package_type;
        $this->service_id = $packagemaster->service_id;
        $this->makka_rating = $packagemaster->makka_rating;
        $this->makka_hotel = $packagemaster->makka_hotel;
        $this->makaHotel = HotelMaster::where('star_rating', $packagemaster->makka_rating)
            ->where('city_id', 1)
            ->pluck('hotel_name', 'id');

        $this->madina_rating = $packagemaster->madina_rating;
        $this->madina_hotel = $packagemaster->madina_hotel;
        $this->madinaHotel = HotelMaster::where('star_rating', $packagemaster->madina_rating)
            ->where('city_id', 2)
            ->pluck('hotel_name', 'id');
        $this->moullim_no = $packagemaster->moullim_no ?? '';
        $this->stay_id = $packagemaster->stay_id ?? '';
        $this->food_type = $packagemaster->food_type;
        $this->transport_type = $packagemaster->transport_type;
        $this->laundray_type = $packagemaster->laundray_type;
        $this->dept_city_id = $packagemaster->dept_city_id;
        $this->flight_id = $packagemaster->flight_id;
        $this->g_share_price = $packagemaster->g_share_price;
        $this->qt_share_price = $packagemaster->qt_share_price;
        $this->qd_share_price = $packagemaster->qd_share_price;
        $this->d_share_price = $packagemaster->d_share_price;
        $this->t_share_price = $packagemaster->t_share_price;
        $this->single_price = $packagemaster->single_price;
        $this->child_w_b = $packagemaster->child_w_b;
        $this->child_wo_b = $packagemaster->child_wo_b;
        $this->infants = $packagemaster->infants;
        // $this->zamzam = $packagemaster->zamzam;
        // $this->ziyarat = $packagemaster->ziyarat;
        $this->package_image = $packagemaster->package_image;
        $this->description = $packagemaster->description;
        $this->package_includes = explode(',', $packagemaster->package_includes);
    }

    public function update()
    {
        $rules = [
            'package_name' => 'required',
            'package_type' => 'required',
            'service_id' => 'required',
            'food_type' => 'required',
            'transport_type' => 'required',
            'laundray_type' => 'required',
            'dept_city_id' => 'required',
            'flight_id' => 'required',
            'g_share_price' => 'required',
            'qt_share_price' => 'required',
            'qd_share_price' => 'required',
            't_share_price' => 'required',
            'd_share_price' => 'required',
            'single_price' => 'required',
            'child_w_b' => 'required',
            'child_wo_b' => 'required',
            'infants' => 'required',
            'description' => 'required',
            'package_includes' => 'required',
            // 'package_image' => 'sometimes|nullable|image',
        ];

        // Add conditional rules based on the value of service_id
        if ($this->service_id == 1) {
            $rules['makka_rating'] = 'required';
            $rules['makka_hotel'] = 'required';
            $rules['madina_rating'] = 'required';
            $rules['madina_hotel'] = 'required';
        } elseif ($this->service_id == 2) {
            $rules['moullim_no'] = 'required';
            $rules['makka_rating'] = 'required';
            $rules['makka_hotel'] = 'required';
            $rules['madina_rating'] = 'required';
            $rules['madina_hotel'] = 'required';
        } elseif ($this->service_id == 3) {
            $rules['stay_id'] = 'required';
        }

        if (empty($this->package_image)) unset($rules['package_image']);

        $messages = [
            'package_name.required' => 'Package Name is required',
            'package_type.required' => 'Package Type is required',
            'service_id.required' => 'Service is required',
            'makka_rating.required' => 'Makka Hotel Category is required',
            'makka_hotel.required' => 'Makka Hotel is required',
            'madina_rating.required' => 'Madina Hotel Category is required',
            'madina_hotel.required' => 'Madina Hotel is required',
            'food_type.required' => 'Food Type is required',
            'transport_type.required' => 'Transfers Type is required',
            'laundray_type.required' => 'Laundray Type is required',
            'dept_city_id.required' => 'Departure City is required',
            'flight_id.required' => 'Air Line is required',
            'g_share_price.required' => 'Sharing is required',
            'qt_share_price.required' => 'Quint is required',
            'qd_share_price.required' => 'Quad is required',
            't_share_price.required' => 'Triple is required',
            'd_share_price.required' => 'Double is required',
            'single_price.required' => 'Single is required',
            'child_w_b.required' => 'Child with Bed is required',
            'child_wo_b.required' => 'Child without Bed is required',
            'infants.required' => 'Infants are required',
            'description.required' => 'Description is required',
            'package_includes.required' => 'Package Includes is required',
            'package_image.image' => 'Package Image must be an image',
            'moullim_no.required' => 'Moullim No is required',
            'stay_id.required' => 'Stay ID is required',
        ];
        // dd($rules,$messages);
        $validated = $this->validate($rules, $messages);

        $validated['package_includes'] = implode(',', $validated['package_includes']);

        if (isset($validated['package_image']) && $validated['package_image'] instanceof \Illuminate\Http\UploadedFile) {
            $uuid = Str::uuid();
            $imageExtension = $validated['package_image']->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            Storage::putFileAs('public/package_image', $validated['package_image'], $imageName);
            $validated['package_image'] = $imageName;
        }
        $validated['is_active'] = $this->status ?? 1;

        $package = PackageMaster::find($this->id);
        $package->update($validated);

        $this->alert('success', 'Successfully Updated');
        return redirect()->route('admin.package.index');
    }

    public function changeFields()
    {
        // /
    }


    public function getModalContent($selectedValue, $dropdown)
    {
        if ($selectedValue && $dropdown === 'makka') {
            $this->makaHotel = HotelMaster::where('star_rating', $selectedValue)
                ->where('city_id', 1)
                ->pluck('hotel_name', 'id');
        } elseif ($selectedValue && $dropdown === 'madina') {
            $this->madinaHotel = HotelMaster::where('star_rating', $selectedValue)
                ->where('city_id', 2)
                ->pluck('hotel_name', 'id');
        }
    }
    public function render()
    {
        return view('admin.packages.package-edit-component');
    }
}
