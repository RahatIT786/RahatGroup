<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Models\Agent\Content;
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

class PackageCreateComponent extends Component
{
    use LivewireAlert, WithFileUploads;

    // public $payment_policy;
    // public $important_notes;
    // public $cancellation_policy;

    public $package_name, $package_image = [], $description;
    public $umrah_type;
    public $package_type_ids = [];
    public $serviceType, $service_id;
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

    // Initialize arrays to avoid null values
    public function mount()
    {
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->foodMaster = FoodMaster::with('packagetype')->get();
        $this->lundrayMaster = LaundryMaster::pluck('lundray_type', 'id');
        $this->serviceType = ServiceType::active()->get();

        $this->payment_policy = Content::where('page_id', 24)->value('description'); // Replace 'description' with the actual column name
        $this->important_notes = Content::where('page_id', 25)->value('description'); // Same here
        $this->cancellation_policy = Content::where('page_id', 26)->value('description'); // And here
    }
    public function changeFields()
    {
        // Implement any additional logic needed when the service_id is changed

        if ($this->service_id != 2) {
            $this->umrah_type = '';
        }
    }

    public function getPackageForm($value)
    {

        $this->package_type_ids = PackageType::whereIn('id', $value)->pluck('package_type', 'id')->toArray();
        $validated = $this->validate([
            'package_name' => 'required',
            'package_type_ids' => 'required',
            'service_id' => 'required',
            'description' => 'required',
            'package_image.*' => 'required|image',
            'package_includes.*' => 'required',
        ]);
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

    public function packageInclude($index)
    {
        $this->package_includes[$index] = array_filter($this->package_includes[$index]);
    }
    public function save()
    {
        // dd($this->package_includes);
        // $payment_policy,$important_notes,$cancellation_policy,$flight_transport,$meals,$visa_taxes

        foreach ($this->package_type_ids as $key => $value) {
            $validated = $this->validate([
                'makka_rating.' . $key    => 'required',
                'makka_hotel.' . $key     => 'required',
                'madina_rating.' . $key   => 'required',
                'madina_hotel.' . $key    => 'required',
                'food_type.' . $key       => 'required',
                'laundray_type.' . $key   => 'required',
                'g_share_price.' . $key   => 'required',
                // 'qt_share_price.' . $key  => 'required',
                // 'qd_share_price.' . $key  => 'required',
                // 't_share_price.' . $key   => 'required',
                // 'd_share_price.' . $key   => 'required',
                // 'single_price.' . $key    => 'required',
                'child_w_b.' . $key       => 'required',
                'child_wo_b.' . $key      => 'required',
                'infants.' . $key         => 'required',
                // 'package_includes.' . $key   => 'required|array|min:1',
            ], [
                'makka_rating.' . $key . '.required'    => 'Please select a hotel rating',
                'makka_hotel.' . $key . '.required'     => 'Please select a hotel',
                'madina_rating.' . $key . '.required'   => 'Please select a hotel rating',
                'madina_hotel.' . $key . '.required'    => 'Please select a hotel',
                'food_type.' . $key . '.required'       => 'Please enter food type',
                'laundray_type.' . $key . '.required'   => 'Please enter laundry type',
                'g_share_price.' . $key . '.required'   => 'Please enter general sharing price',
                // 'qt_share_price.' . $key . '.required'  => 'Please enter quint sharing price',
                // 'qd_share_price.' . $key . '.required'  => 'Please enter quad sharing price',
                // 't_share_price.' . $key . '.required'   => 'Please enter triple sharing price',
                // 'd_share_price.' . $key . '.required'   => 'Please enter double sharing price',
                // 'single_price.' . $key . '.required'    => 'Please enter single sharing price',
                'child_w_b.' . $key . '.required'       => 'Please enter price for child with bed',
                'child_wo_b.' . $key . '.required'      => 'Please enter price for child without bed',
                'infants.' . $key . '.required'         => 'Please enter price for infant',
                // 'package_includes.' . $key . '.required' => 'Please select at least one option',
                // 'package_includes.' . $key . '.array'   => 'The package includes field must be an array',
                // 'package_includes.' . $key . '.min'     => 'Please select at least one option',
            ]);
        }

        // Create package
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


        $package = Packages::create($pkg_data);

        foreach ($this->package_image as $photo) {

            $uuid = Str::uuid();
            $imageExtension = $photo->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            // $photo->storeAs('public/package_image', $imageName);
            Storage::putFileAs('public/package_image', $photo, $imageName);
            PackageImage::create([
                'pkg_id' => $package->id,
                'pkg_img' => $imageName,
            ]);
        }

        //Create Package details
        $details_data = [];
        // $package_includes = implode(',', $this->package_includes);
        $keys = array_keys($this->package_includes);
        $package_includes = implode(',', $keys);

        foreach ($this->package_type_ids as $key => $value) {
            // $keys = array_keys($this->package_includes[$key]);
            // $package_includes = implode(',', $keys);

            $details_data[] = [
                'pkg_id' => $package->id,
                'pkg_type_id' => $key,
                'makka_category' => $this->makka_rating[$key] ?? null,
                'makka_hotel_id' => $this->makka_hotel[$key] ?? null,
                'madina_category' => $this->madina_rating[$key] ?? null,
                'madina_hotel_id' => $this->madina_hotel[$key] ?? null,
                'meal_type' => $this->food_type[$key] ?? null,
                'laundry_type' => $this->laundray_type[$key] ?? null,
                'g_share' => isset($this->g_share_price[$key]) && $this->g_share_price[$key] != "" ? $this->g_share_price[$key] : 0,
                'qt_share' => isset($this->qt_share_price[$key]) && $this->qt_share_price[$key] != "" ? $this->qt_share_price[$key] : 0,
                'qd_share' => isset($this->qd_share_price[$key]) && $this->qd_share_price[$key] != "" ? $this->qd_share_price[$key] : 0,
                't_share' => isset($this->t_share_price[$key]) && $this->t_share_price[$key] != "" ? $this->t_share_price[$key] : 0,
                'd_share' => isset($this->d_share_price[$key]) && $this->d_share_price[$key] != "" ? $this->d_share_price[$key] : 0,
                'single' => isset($this->single_price[$key]) && $this->single_price[$key] != "" ? $this->single_price[$key] : 0,
                'child_with_bed' => $this->child_w_b[$key] ?? 0,
                'chlid_no_bed' => $this->child_wo_b[$key] ?? 0,
                'infant' => $this->infants[$key] ?? 0,
                'package_includes' => $package_includes,
            ];
        }
        // dd($details_data);
        foreach ($details_data as $details) {

            PackageDetails::create($details);
        }

        $this->alert('success', 'Created Successfully');
        return redirect()->route('admin.package.index');
    }
    public function render()
    {
        return view('admin.packages.package-create-component');
    }
}
