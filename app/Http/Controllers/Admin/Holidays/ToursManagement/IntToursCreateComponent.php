<?php

namespace App\Http\Controllers\Admin\Holidays\ToursManagement;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\PackageType;
use App\Models\Country;
use App\Models\IntTourDestination;
use App\Models\HotelMaster;
use App\Models\IntHolidayTour;
use App\Models\IntHolidayTourDetails;
use App\Models\IntTourImage;
use App\Models\TourCategory;
use App\Helpers\Helper;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class IntToursCreateComponent extends Component
{   
    use LivewireAlert, WithFileUploads;

    public $tour_name, $tourType, $countries, $destinations, $package_types, $tour_categories, $tour_includes;
    public $package_type_ids, $tour_cat_id, $country_id, $destination_ids, $itinerary;
    public $packageTypes = [], $tour_image = [], $hotel_rating = [], $hotels = [], $selectedThemes = [], $selectedIncludes = [], $selectedHotels = [], $nights = [], $price = [];

    public function mount()
    {   


        $abc = IntHolidayTour::get();
        $this->packageTypes = PackageType::pluck('package_type', 'id');
        // $this->tourType = Helper::tourType();
        $this->countries = Country::get();
        $this->tour_categories = TourCategory::get();
        $this->tour_includes = Helper::tourIncludes();
        
    }   
    public function getDestinations()
    {
        if ($this->country_id != null) {
            $this->destinations = IntTourDestination::where('country_id', $this->country_id)->get();
        }
    }

    public function getPackageForm()
    {

        $validated = $this->validate([
            'tour_name' => 'required',
            'country_id' => 'required',
            'package_type_ids' => 'required',
            'destination_ids' => 'required',
            'tour_image.*' => 'required|image',
            'selectedThemes' => 'required',
            'selectedIncludes' => 'required',
        ], [
            'tour_name.required' => 'The tour name field is required.',
            'country_id.required' => 'Please select a country.',
            'package_type_ids.required' => 'Please select at least one package type.',
            'destination_ids.required' => 'Please select at least one destination.',
            'tour_image.required' => 'You must upload at least one image for the tour.',
            'tour_image.image' => 'Each uploaded file must be an image.',
            'selectedThemes.required' => 'Please select at least one theme.',
            'selectedIncludes.required' => 'Please select at least one include option.',

        ]);

        // Fetch destinations based on selected IDs
        if ($this->destination_ids) {
            $this->destinations = IntTourDestination::whereIn('id', $this->destination_ids)->get();

        }

        // Fetch package types based on passed IDs
        if ($this->package_type_ids) {
            $this->package_types = PackageType::whereIn('id', $this->package_type_ids)->pluck('package_type', 'id')->toArray();
        }

        // Validate the required fields

    }
    public function save()
    {

        $rules = [];

        foreach ($this->package_types as $key => $value) {
            foreach ($this->destination_ids as $destination_id) {
                $rules['selectedHotels.' . $key . '.' . $destination_id] = 'required';
                $rules['nights.' . $key . '.' . $destination_id] = 'required';

            }
            $rules['price.' . $key] = 'required';
        }

        // Perform validation with the complete rules array
        $validated = $this->validate($rules);

        $destination_ids = implode(',', $this->destination_ids);
        $tour_types = implode(',', $this->package_type_ids);
        $includes = implode(',', $this->selectedIncludes);
        $themes = implode(',', $this->selectedThemes);
        $tour_package = [];

        $firstKey = key($this->nights);
        $totalNights = array_sum($this->nights[$firstKey]);

        $tour_package = [
            'name' => $this->tour_name,
            'country_id' => $this->country_id,
            'destination' => $destination_ids,
            'tour_types' => $tour_types,
            'itinerary' => $this->itinerary,
            'includes' => $includes,
            'categories' => $themes,
            'nights' => $totalNights,
            'slug'=> Str::slug($this->tour_name)
        ];
        //  dd($tour_package);
        $tour = IntHolidayTour::create($tour_package);


        foreach ($this->tour_image as $photo) {

            $uuid = Str::uuid();
            $imageExtension = $photo->getClientOriginalExtension();
            $imageName = $uuid . '.' . $imageExtension;
            // $photo->storeAs('public/package_image', $imageName);
            Storage::putFileAs('public/domestic_tour_image', $photo, $imageName);
            IntTourImage::create([
                'tour_id' => $tour->id,
                'tour_img' => $imageName,
            ]);
        }

        // HolidayTourDetails
        foreach ($this->package_types as $key => $value) {
            foreach ($this->destination_ids as $destination_id) {
                $details_data = [
                    'int_tour_id' => $tour->id,
                    'tour_type_id' => $key,
                    'destination_id' => $destination_id,
                    'hotel_id' => $this->selectedHotels[$key][$destination_id],
                    'nights' => $this->nights[$key][$destination_id],
                    'price' => $this->price[$key],
                ];
                IntHolidayTourDetails::create($details_data);
            }
        }

        $this->alert('success', 'Holiday package created successfully');
        return redirect()->route('admin.intTours.index');

    }
    public function render()
    {
        return view('admin.holidays.tours-management.int-tours-create-component');
    }
}
