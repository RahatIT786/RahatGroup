<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Models\City;
use App\Models\FlightMaster;
use App\Models\FoodMaster;
use App\Models\HotelMaster;
use App\Models\LaundryMaster;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\PackageDetails;
use App\Models\PackageType;
use App\Models\ServiceType;
use App\Models\PackageImage;
use App\Models\TransportMaster;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class PackageEditComponent extends Component
{
    use LivewireAlert, WithFileUploads;
    public $package_name, $package_image = [], $description;
    public $type_ids = [], $package_type_ids = [];
    public $umrah_type;

    public $serviceType, $service_id, $package_image_edit;
    public $makka_rating = [];
    public $makkaHotel = [], $makka_hotel = [];
    public $madina_rating = [];
    public $madinaHotel = [], $madina_hotel = [];
    public $packageType = [];
    public $foodMaster = [], $food_type = [];
    public $lundrayMaster = [], $laundray_type = [];
    public $package_includes = [];

    public $g_share_price = [], $qt_share_price = [], $qd_share_price = [], $t_share_price = [], $d_share_price = [], $single_price = [], $child_w_b = [], $child_wo_b = [], $infants = [];
    public $payment_policy, $important_notes, $cancellation_policy, $flight_transport, $meals, $meals1, $visa_taxes, $inclusion, $exlusion, $itinerary;
    public $package;
    public $packageIncludesOptions = [
        'Zamzam',
        'Transfers',
        'Saudi Sim',
        'Welcome Kit',
        'Meals',
        'Ziyarat',
        'Visa',
        'Ticket'
    ];

    public function mount($package)
    {
        $this->package = Packages::with('pkgDetails')->where('id', $package)->first();
        // dd($this->package);
        $this->serviceType = ServiceType::active()->get();
        $this->type_ids = explode(',', $this->package->type_ids);

        $this->umrah_type = $this->package->umrah_type;
        $this->packageType = PackageType::asc()->pluck('package_type', 'id');

        $this->foodMaster = FoodMaster::with('packagetype')->get();
        $this->lundrayMaster = LaundryMaster::pluck('lundray_type', 'id');

        //Edit Values
        $this->service_id = $this->package->service_id ?? '';
        $this->package_name = $this->package->name;
        $this->description = $this->package->description;

        $this->payment_policy = $this->package->payment_policy ?? '';
        $this->important_notes = $this->package->important_notes ?? '';
        $this->cancellation_policy = $this->package->cancellation_policy ?? '';
        $this->flight_transport = $this->package->flight_transport ?? '';
        $this->meals1 = $this->package->meals ?? '';
        $this->visa_taxes = $this->package->visa_taxes ?? '';
        $this->inclusion = $this->package->inclusion ?? '';
        $this->exlusion = $this->package->exclusion ?? '';
        $this->itinerary = $this->package->itinerary ?? '';


        $this->package_image_edit = PackageImage::where('pkg_id', $this->package->id)->pluck('pkg_img', 'id');
        // $query= PackageDetails::query();

        $query = PackageDetails::query()->where('pkg_id', $this->package->id);
        $this->package_type_ids = PackageDetails::where('pkg_id', $this->package->id)->pluck('pkg_type_id')->toArray();
        // dd( $this->package_type_ids);
        $this->package_type_ids = PackageType::whereIn('id', $this->package_type_ids)->pluck('package_type', 'id')->toArray();
        //   dd($this->packageType,$this->package_type_ids);
        // dd( $this->package_type_ids);
        $this->makka_rating = $query->pluck('makka_category', 'pkg_type_id')->toArray();
        $this->madina_rating = $query->pluck('madina_category', 'pkg_type_id')->toArray();

        foreach ($this->makka_rating as $key => $val) {
            $this->makkaHotel[$key] = HotelMaster::where('star_rating', $val)
                ->where('city_id', 1)
                ->pluck('hotel_name', 'id')->toArray();
        }

        $this->makka_hotel = $query->pluck('makka_hotel_id', 'pkg_type_id')->toArray();
        $this->madina_hotel = $query->pluck('madina_hotel_id', 'pkg_type_id')->toArray();

        $this->food_type = $query->pluck('meal_type', 'pkg_type_id')->toArray();
        $this->laundray_type = $query->pluck('laundry_type', 'pkg_type_id')->toArray();


        foreach ($this->madina_rating as $key => $val) {
            $this->madinaHotel[$key] = HotelMaster::where('star_rating', $val)
                ->where('city_id', 2)
                ->pluck('hotel_name', 'id')->toArray();
        }

        $this->g_share_price = $query->pluck('g_share', 'pkg_type_id')->toArray();
        $this->qt_share_price = $query->pluck('qt_share', 'pkg_type_id')->toArray();
        $this->qd_share_price = $query->pluck('qd_share', 'pkg_type_id')->toArray();
        $this->t_share_price = $query->pluck('t_share', 'pkg_type_id')->toArray();
        $this->d_share_price = $query->pluck('d_share', 'pkg_type_id')->toArray();
        $this->single_price = $query->pluck('single', 'pkg_type_id')->toArray();
        $this->child_w_b = $query->pluck('child_with_bed', 'pkg_type_id')->toArray();
        $this->child_wo_b = $query->pluck('chlid_no_bed', 'pkg_type_id')->toArray();
        $this->infants = $query->pluck('infant', 'pkg_type_id')->toArray();
        //  dd($this->g_share_price);
        $raw_array = $query->where('pkg_id', $package)->pluck('package_includes', 'pkg_type_id')->toArray();

        foreach ($raw_array as $key => $value) {
            $includes = explode(',', $value);
            $this->package_includes = array_fill_keys($includes, true);
        }

        // dd($this->package_includes);
    }

    public function getPackageForm($value)
    {

        $this->package_type_ids = PackageType::whereIn('id', $value)->pluck('package_type', 'id')->toArray();
        $validated = $this->validate([
            'package_name' => 'required',
            'package_type_ids' => 'required',
            'service_id' => 'required',
            'description' => 'required',
            // 'package_image' => 'required',
            'package_includes.*' => 'required',
        ]);
    }

    public function hideForm($value)
    {
        $this->package_type_ids = PackageType::whereIn('id', $value)->pluck('package_type', 'id')->toArray();
    }



    public function resetForm()
    {
        $this->reset(
            'type_ids',
            'package_type_ids',
            'makka_rating',
            'makkaHotel',
            'makka_hotel',
            'madina_rating',
            'madinaHotel',
            'madina_hotel',
            'foodMaster',
            'food_type',
            'lundrayMaster',
            'laundray_type',
            'package_includes',
            'g_share_price',
            'qt_share_price',
            'qd_share_price',
            't_share_price',
            'd_share_price',
            'single_price',
            'child_w_b',
            'child_wo_b',
            'infants'
        );
    }

    public function getMakkaHotel($index)
    {

        // Fetch hotels based on the selected rating
        $hotels = HotelMaster::where('star_rating', $this->makka_rating[$index])
            ->where('city_id', 1)
            ->pluck('hotel_name', 'id')->toArray();
        $this->makkaHotel[$index] = $hotels;
    }

    public function getMadinaHotel($index)
    {

        // Fetch hotels based on the selected rating
        $hotels = HotelMaster::where('star_rating', $this->madina_rating[$index])
            ->where('city_id', 2)
            ->pluck('hotel_name', 'id')->toArray();
        $this->madinaHotel[$index] = $hotels;
    }

    function transformArray($array)
    {
        $result = [];

        foreach ($array as $key => $value) {
            $includes = explode(',', $value);
            $result[$key] = array_fill_keys($includes, true);
        }

        return $result;
    }

    public function packageInclude($index)
    {
        $this->package_includes[$index] = array_filter($this->package_includes[$index]);
    }

    public function update()
    {
        // dd($this->package_image);
        $package_type_ids_keys = array_keys($this->package_type_ids);
        $delete_rows = PackageDetails::where('pkg_id', $this->package->id)->whereNot('pkg_type_id', $package_type_ids_keys)->get();
        foreach ($delete_rows  as $row) {
            $row->delete();
        }

        foreach ($this->package_type_ids as $key => $value) {
            $validated = $this->validate([
                'makka_rating.' . $key => 'required',
                'makka_hotel.' . $key => 'required',
                'madina_rating.' . $key => 'required',
                'madina_hotel.' . $key => 'required',
                'food_type.' . $key => 'required',
                'laundray_type.' . $key => 'required',
                'g_share_price.' . $key => 'required',
                // 'qt_share_price.' . $key => 'required',
                // 'qd_share_price.' . $key => 'required',
                // 't_share_price.' . $key => 'required',
                // 'd_share_price.' . $key => 'required',
                // 'single_price.' . $key => 'required',
                'child_w_b.' . $key => 'required',
                'child_wo_b.' . $key => 'required',
                'infants.' . $key => 'required',
                // 'package_includes.' . $key => 'required|array|min:1',
            ], [
                'makka_rating.' . $key . '.required' => 'Please select a hotel rating',
                'makka_hotel.' . $key . '.required' => 'Please select a hotel',
                'madina_rating.' . $key . '.required' => 'Please select a hotel rating',
                'madina_hotel.' . $key . '.required' => 'Please select a hotel',
                'food_type.' . $key . '.required' => 'Please enter food type',
                'laundray_type.' . $key . '.required' => 'Please enter laundry type',
                'g_share_price.' . $key . '.required' => 'Please enter general sharing price',
                // 'qt_share_price.' . $key . '.required' => 'Please enter quint sharing price',
                // 'qd_share_price.' . $key . '.required' => 'Please enter quad sharing price',
                // 't_share_price.' . $key . '.required' => 'Please enter triple sharing price',
                // 'd_share_price.' . $key . '.required' => 'Please enter double sharing price',
                // 'single_price.' . $key . '.required' => 'Please enter single sharing price',
                'child_w_b.' . $key . '.required' => 'Please enter price for child with bed',
                'child_wo_b.' . $key . '.required' => 'Please enter price for child without bed',
                'infants.' . $key . '.required' => 'Please enter price for infant',
                // 'package_includes.' . $key . '.required' => 'Please select at least one option',
                // 'package_includes.' . $key . '.array' => 'The package includes field must be an array',
                // 'package_includes.' . $key . '.min' => 'Please select at least one option',
            ]);
        }

        $keys = array_keys($this->package_type_ids);
        $id_string = implode(',', $keys);

        $pkg_data = [
            'name' => $this->package_name,
            'type_ids' => $id_string,
            'service_id' => $this->service_id,
            'umrah_type' => $this->umrah_type != '' ? $this->umrah_type : null,
            'description' => $this->description,
            'payment_policy' => $this->payment_policy,
            'important_notes' => $this->important_notes,
            'cancellation_policy' => $this->cancellation_policy,
            'flight_transport' => $this->flight_transport,
            'meals' => $this->meals1,
            'visa_taxes' => $this->visa_taxes,
            'inclusion' => $this->inclusion,
            'exclusion' => $this->exlusion,
            'itinerary' => $this->itinerary
        ];
        Packages::where('id', $this->package->id)->update($pkg_data);


        // Handle the image upload

        if (!empty($this->package_image)) {
            // Delete existing images if new images are uploaded
            $existingImages = PackageImage::where('pkg_id', $this->package->id)->get();
            foreach ($existingImages as $image) {
                Storage::delete('public/package_image/' . $image->pkg_img);
                $image->delete();
            }
            // Upload new images
            foreach ($this->package_image as $photo) {
                $uuid = Str::uuid();
                $imageExtension = $photo->getClientOriginalExtension();
                $imageName = $uuid . '.' . $imageExtension;
                // $photo->storeAs('public/hotel', $imageName);
                Storage::putFileAs('public/package_image', $photo, $imageName);
                PackageImage::create([
                    'pkg_id' => $this->package->id,
                    'pkg_img' => $imageName,
                ]);
            }
        }

        $details_data = [];

        $this->package_includes = array_filter($this->package_includes);
        $keys = array_keys($this->package_includes);
        $package_includes = implode(',', $keys);
        foreach ($this->package_type_ids as $key => $value) {
            // $keys = array_keys($this->package_includes[$key]);
            // $package_includes = implode(',', $keys);

            $details_data[] = [
                'pkg_id' => $this->package->id,
                'pkg_type_id' => $key,
                'makka_category' => $this->makka_rating[$key],
                'makka_hotel_id' => $this->makka_hotel[$key],
                'madina_category' => $this->madina_rating[$key],
                'madina_hotel_id' => $this->madina_hotel[$key],
                'meal_type' => $this->food_type[$key],
                'laundry_type' => $this->laundray_type[$key],
                'g_share' => $this->g_share_price[$key],
                'qt_share' => $this->qt_share_price[$key] == '' ? 0 : $this->qt_share_price[$key],
                'qd_share' => $this->qd_share_price[$key] == '' ? 0 : $this->qd_share_price[$key],
                't_share' => $this->t_share_price[$key] == '' ? 0 : $this->t_share_price[$key],
                'd_share' => $this->d_share_price[$key] == '' ? 0 : $this->d_share_price[$key],
                'single' => $this->single_price[$key] == '' ? 0 : $this->single_price[$key],
                'child_with_bed' => $this->child_w_b[$key],
                'chlid_no_bed' => $this->child_wo_b[$key],
                'infant' => $this->infants[$key],
                'package_includes' => $package_includes,
            ];
        }

        foreach ($details_data as $detail_data) {
            $detail = PackageDetails::where('pkg_id', $detail_data['pkg_id'])
                ->where('pkg_type_id', $detail_data['pkg_type_id'])
                ->first();
            if ($detail) {
                $detail->update($detail_data);
            } else {
                PackageDetails::create($detail_data);
            }
        }

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
