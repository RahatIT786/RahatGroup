<?php

namespace App\Http\Controllers\User\Pages;

use App\Helpers\Helper;
use App\Models\Bookingenquiry;
use App\Models\City;
use App\Models\FlightMaster;
use App\Models\PackageType;
use App\Models\Packages;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class UmrahLandViewComponent extends Component
{
    use WithFileUploads;

    public $captchaImage;
    public $packages, $selectedCategory, $packageId, $package_id, $packageType, $pkgDetails, $service_id;
    public $serviceArray = [], $packageArray = [], $subPackageArray = [], $selectedFlavour = [], $selectedFlavourPrice = [], $flavour;
    public $cat_id, $selectedPackageFlavourId, $allIncludes, $pkgIncludes, $package_type;
    public $g_share, $qt_share, $qd_share, $t_share, $d_share, $single, $child_with_bed, $child_no_bed, $infant, $makkahotel, $madinahotel, $city, $flight, $city_id, $airline_id;
    // public $service_id = 1; // Default to service_id 1
    public $flv_sessions_data = [];

    #[Validate]
    public $cust_name;

    #[Validate]
    public $cust_email;

    #[Validate]
    public $cust_num;

    #[Validate]
    public $travel_date;

    #[Validate]
    public $food;

    #[Validate]
    public $visa;

    #[Validate]
    public $air_ticket;

    #[Validate]
    public $cust_msg;

    #[Validate]
    public $pkg_type_id;

    #[Validate]
    public $pkg_flavour_id;

    #[Validate]
    public $userInput;

    protected $listeners = ['putInData'];

    public function mount($id,$type)
    {
        // Access session variables
        $this->packageId = $id;
        $this->selectedPackageFlavourId = $type;
        $this->city = City::pluck('city_name', 'id');
        $this->flight = FlightMaster::pluck('flight_name', 'id');
        // dd($this->city);


        $this->selectedCategory = 22; // Default to 'Deluxe'
        $this->packageType = PackageType::pluck('package_type', 'id');
        $this->serviceArray = ServiceType::has('packages')->active()->get();
        $this->packages = Packages::where('id', $id)->with('pkgDetails.packageType')->first();
        // $this->generateCaptcha();

        if ($this->packages) {
            $packageTypeIds = $this->packages->pkgDetails->pluck('packageType.id');
            $this->packageType = PackageType::whereIn('id', $packageTypeIds)->pluck('package_type', 'id');
        } else {
            $this->packageType = collect();
        }

       
        $this->allIncludes = Helper::packageIncludesOptions();
        $firstFlavour = $this->packages->pkgDetails->where('pkg_type_id', $this->selectedPackageFlavourId)->first()->package_includes;
        $this->pkgIncludes = explode(",", $firstFlavour);
        $this->updatePackageIncludes();
        $this->service_id = $this->packages->service_id;
        $this->package_id = $this->packages->id;
    }

    public function putInData()
    {
        //
    }

    public function changeFlavour()
    {
        $this->updatePackageIncludes();
    }

    private function updatePackageIncludes()
    {
        $selectedFlavour = $this->packages->pkgDetails->where('pkg_type_id', $this->selectedPackageFlavourId)->first();

        if ($selectedFlavour) {
            $this->pkgIncludes = explode(",", $selectedFlavour->package_includes);
            $this->updatePackagePrices($selectedFlavour);
        } else {
            $this->pkgIncludes = [];
        }
    }

    private function updatePackagePrices($selectedFlavour)
    {
        $this->g_share = $selectedFlavour->g_share;
        $this->qt_share = $selectedFlavour->qt_share;
        $this->qd_share = $selectedFlavour->qd_share;
        $this->t_share = $selectedFlavour->t_share;
        $this->d_share = $selectedFlavour->d_share;
        $this->single = $selectedFlavour->single;
        $this->child_with_bed = $selectedFlavour->child_with_bed;
        $this->child_no_bed = $selectedFlavour->chlid_no_bed;
        $this->infant = $selectedFlavour->infant;

        // Update hotels
        $this->makkahotel = $selectedFlavour->makkahotel;
        $this->madinahotel = $selectedFlavour->madinahotel;
    }

    public function rules()
    {
        return [
            'city_id' => 'required',
            'travel_date' => 'required|date',
            'airline_id' => 'required',
            'selectedPackageFlavourId' => 'required',
        ];
    }
    public function changeName()
    {
        // Final validation check before processing
        $this->validate($this->rules());
    }

    //To download Hajj Package PDF file
    public function downloadPackage($packageId)
    {
            // Retrieve the package with related details
            $packageData = Packages::query()
            ->whereId($packageId)
            ->with(['pkgDetails.packageType', 'pkgDetails.makkahotel', 'pkgDetails.madinahotel', 'pkgDetails.makkahotel.hotelimage', 'pkgDetails.madinahotel.hotelimage', 'pkgImages', 'serviceType'])
            ->first();

        if (!$packageData) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $packageDetails = $packageData->pkgDetails->map(function ($detail) {
            return [
                'package_type' => $detail->packageType->package_type,
                'makkahotel' => $detail->makkahotel->hotel_name ?? 'N/A',
                'madinahotel' => $detail->madinahotel->hotel_name ?? 'N/A',
                'makkah_hotel_star_rating' => $detail->makkahotel->star_rating ?? 'N/A',
                'madinah_hotel_star_rating' => $detail->madinahotel->star_rating ?? 'N/A',
                'g_share' => $detail->g_share ?? 'N/A',
                'qt_share' => $detail->qt_share ?? 'N/A',
                'qd_share' => $detail->qd_share ?? 'N/A',
                't_share' => $detail->t_share ?? 'N/A',
                'd_share' => $detail->d_share ?? 'N/A',
                'single' => $detail->single ?? 'N/A',
                'child_with_bed' => $detail->child_with_bed ?? 'N/A',
                'child_no_bed' => $detail->chlid_no_bed ?? 'N/A',
                'infant' => $detail->infant ?? 'N/A',
                'package_includes' => $detail->package_includes ?? 'N/A',
                'makkah_hotel_image' => $detail->makkahotel->hotelimage->pluck('hotel_img')->first(),
                'madinah_hotel_image' => $detail->madinahotel->hotelimage->pluck('hotel_img')->first(),
            ];
        });
        $data = [
            'package_name' => $packageData->name ?? '',
            'itinerary' => $packageData->itinerary ?? '',
            'inclusion' => $packageData->inclusion ?? '',
            'exclusion' => $packageData->exclusion ?? '',
            'visa_taxes' => $packageData->visa_taxes ?? '',
            'meals' => $packageData->meals ?? '',
            'payment_policy' => $packageData->payment_policy ?? '',
            'important_notes' => $packageData->important_notes ?? '',
            'flight_transport' => $packageData->flight_transport ?? '',
            'cancellation_policy' => $packageData->cancellation_policy ?? '',
            'package_details' => $packageDetails,
            'packageData' => $packageData,
        ];
        // Generate the PDF
        $pdf = Pdf::loadView('user.pages.pdf.hajj-packages-pdf-component', $data);

        // Stream the PDF for download
        return $pdf->download('package-document.pdf');
    }

    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.umrah-land-view-component');
    }
}
