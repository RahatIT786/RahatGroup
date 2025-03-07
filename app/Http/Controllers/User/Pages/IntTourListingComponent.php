<?php

namespace App\Http\Controllers\User\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Country;
use App\Models\PriceSet;
use App\Models\IntHolidayTour;
use App\Models\IntHolidayTourDetails;
use App\Models\DomesticTourImage;
use App\Models\TourCategory;
use App\Models\IntTourDestination;
use App\Helpers\Helper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\TourCallUsBack;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use App\Models\Staff;

class IntTourListingComponent extends Component
{
    use LivewireAlert;
    public $destinations, $tours_id, $country_id, $flavour, $selectedFlavour, $selectedFlavourPrice, $includes, $themes;
    public $filter_destinations_ids, $filter_themes_ids, $price_filter, $lowestPrice, $highestPrice, $price_range_id;
    public $selectedThemes = [], $selectedDestinations = [], $selected_price_ranges = [], $selectedNights = [];
    public  $selectedTourTypes;
    public  $captchaImage;
    public $search_tours = '';
    public $tours = [];
    public $selectedFlavourNights = [];
    public $filter_themes = [];
    public $filter_destinations = [];

    #[Validate('required')]
    public $title;
    #[Validate('required')]
    public $f_name;
    #[Validate('required')]
    public $l_name;
    #[Validate('required')]
    public $email_id;
    #[Validate('required')]
    public $mob_num;
    #[Validate('required')]
    public $travel_date;
    #[Validate('required')]
    public $destination;
    #[Validate('required')]
    public $adults;
    #[Validate('required')]
    public $children;
    #[Validate('required')]
    public $infants;
    #[Validate('required')]
    public $remarks;
    #[Validate('required')]
    public $userInput;


    public function mount($id)
    {
        $this->generateCaptcha();
        $this->destinations = IntTourDestination::all();
        $this->includes = Helper::tourIncludes();
        $this->themes = TourCategory::all();
        $this->country_id = Country::where('id', $id)->value('id');
        $this->fetchTours();
        // Initialize package flavours
        foreach ($this->tours as $toursKey => $tour) {
            $this->initializePackageFlavours($tour, $toursKey);
            $this->getFilterDestination($tour, $toursKey);
            $this->getFilterThemes($tour, $toursKey);
        }
        $this->getPriceSet();

        $flattenedDestination = array_merge(...$this->filter_destinations_ids);
        $uniqueDestination = array_unique($flattenedDestination);
        $this->filter_destinations = IntTourDestination::whereIn('id', $uniqueDestination)->pluck('name', 'id');

        $flattenedThemes = array_merge(...$this->filter_themes_ids);
        $uniqueThemes = array_unique($flattenedThemes);
        $this->filter_themes = TourCategory::whereIn('id', $uniqueThemes)->pluck('cat_name', 'id');
        // dd($this->selectedFlavourPrice);

        // dd($this->price_filter);
    }

    public function fetchFilters()
    {
        // Fetch distinct nights, themes, and destinations from the database
        $this->selectedFlavourNights = IntHolidayTour::distinct()->pluck('nights')->toArray();
        $this->filter_themes = TourCategory::pluck('cat_name', 'id')->toArray();
        $this->filter_destinations = IntTourDestination::pluck('name', 'id')->toArray();
    }

    public function getFullNameProperty()
    {
        return trim($this->f_name . ' ' . $this->l_name);
    }

    public function fetchTours()
    {
        // Debugging checks (keep if needed)
        if (!empty($this->selectedThemes)) {
            // dd($this->selectedThemes);
        }
        if (!empty($this->selectedDestinations)) {
            // dd($this->selectedDestinations);
        }

        $this->tours = IntHolidayTour::active()
            ->where('country_id', $this->country_id)
            ->with('country', 'tourImages', 'tourDetails')

            // Filter by package name (case-insensitive, partial match)
            ->when(!empty($this->search_tours), function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search_tours . '%');
            })
            // ->when(!empty($this->search_tours), function ($query) {
            //     $query->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($this->search_tours) . '%']);
            // })

            // Filter by selected price ranges
            ->when(!empty($this->selected_price_ranges), function ($q) {
                $q->whereHas('tourDetails', function ($qr) {
                    $rangeList = PriceSet::whereIn('id', $this->selected_price_ranges)->get();
                    $qr->where(function ($query) use ($rangeList) {
                        foreach ($rangeList as $k => $range) {
                            if ($k === 0) {
                                $query->whereBetween('price', [$range->price_from, $range->price_to]);
                            } else {
                                $query->orWhereBetween('price', [$range->price_from, $range->price_to]);
                            }
                        }
                    });
                });
            })

            ->when(!empty($this->selectedTourTypes), function ($query) {
                return $query->whereRaw("FIND_IN_SET(?, tour_types)", $this->selectedTourTypes);
            })
            ->when(!empty($this->selectedNights), fn($q) => $q->whereIn('nights', $this->selectedNights))
            // Filter by selected themes
            ->when(!empty($this->selectedThemes), function ($query) {
                $query->where(function ($query) {
                    foreach ($this->selectedThemes as $theme) {
                        $query->orWhereRaw("FIND_IN_SET(?, categories)", [$theme]);
                    }
                });
            })

            // Filter by selected destinations
            ->when(!empty($this->selectedDestinations), function ($query) {
                $query->where(function ($query) {
                    foreach ($this->selectedDestinations as $destination) {
                        $query->orWhereRaw("FIND_IN_SET(?, destination)", [$destination]);
                    }
                });
            })
            ->get();

        if (!empty($this->selectedTourTypes)) {
            foreach ($this->tours as $key => $value) {
                // $this->selectedflavour($this->selectedTourTypes, $key);
                $this->dispatch('triggerCategoryChange', value: $this->selectedTourTypes, key: $key);
            }
            // dd($this->selectedFlavourPrice, $this->flavour);
        }
    }



    private function getPriceSet()
    {
        // $tourIds = $this->tours->pluck('id');
        // $holidayDetails = HolidayTourDetails::whereIn('domestic_tour_id', $tourIds)->get();
        // $this->lowestPrice = $holidayDetails->min('price');
        // $this->highestPrice = $holidayDetails->max('price');
        // // dd($this->lowestPrice, $this->highestPrice);

        // $this->price_filter = PriceSet::where(function ($query) {
        //     $query->where('price_to', '>=', $this->lowestPrice)
        //         ->where('price_from', '<=', $this->lowestPrice);
        // })->orWhere(function ($query) {
        //     $query->where('price_to', '>=', $this->highestPrice)
        //         ->where('price_from', '<=', $this->highestPrice);
        // })->get();
        // dd($this->price_filter);
    }

    public function changeInput()
    {
        $this->fetchTours();

        if (empty($this->selectedTourTypes)) {
            $this->selected_price_ranges = [];
        } else {
            // foreach ($this->tours as $key => $value) {
            //     $this->selectedflavour($this->selectedTourTypes, $key);
            // }
            // $this->rearrangeFlavours($this->selectedTourTypes);
            // $this->dispatch('triggerCategoryChange', ttype: $this->selectedTourTypes);
        }
        foreach ($this->tours as $toursKey => $tour) {
            $this->initializePackageFlavours($tour, $toursKey);
            $this->getFilterDestination($tour, $toursKey);
            $this->getFilterThemes($tour, $toursKey);
        }
    }
    private function initializePackageFlavours($tour, $toursKey)
    {
        $previousTourTypeId = null;
        foreach ($tour->tourDetails as $detailKey => $tourDetail) {

            $this->flavour[$toursKey][$detailKey] = [
                'tour_type_id' => $tourDetail->tour_type_id,
                'destinations' => $tour->destination,
                'tour_type_name' => $tourDetail->tourType != null ? $tourDetail->tourType->package_type : '',
                'price' => $tourDetail->price,
                'nights' => ''
            ];


            // $this->flavourPrice[$toursKey][$detailKey] = $tourDetail->g_share;

        }
        $nightsSum = [];
        foreach ($tour->tourDetails as $tourDetail) {
            // Check if the tour_type_id is already in the $nightsSum array
            if (isset($nightsSum[$tourDetail->tour_type_id])) {
                // Add the nights to the existing total
                $nightsSum[$tourDetail->tour_type_id] += $tourDetail->nights;
            } else {
                // Initialize with the first value of nights
                $nightsSum[$tourDetail->tour_type_id] = $tourDetail->nights;
            }
        }




        $uniqueItems = [];
        $this->flavour[$toursKey] = array_values(array_filter($this->flavour[$toursKey], function ($detail) use (&$uniqueItems) {
            if (in_array($detail['tour_type_id'], $uniqueItems)) {
                return false;
            }
            $uniqueItems[] = $detail['tour_type_id'];
            return true;
        }));



        foreach ($this->flavour as $flavour) {
            foreach ($flavour as $key => $val) {

                if (array_key_exists($val['tour_type_id'], $nightsSum)) {
                    //  $val['nights'] = $nightsSum[$val['tour_type_id']];
                    $this->flavour[$toursKey][$key]['nights'] = $nightsSum[$val['tour_type_id']];
                }
            }
        }
        $this->selectedFlavourNights[$toursKey] = 0;
        // Set the initial selected flavour and price
        $firstDetailKey = array_key_first($this->flavour[$toursKey]);
        $this->selectedFlavour[$toursKey] = $this->flavour[$toursKey][$firstDetailKey] ?? [];
        $this->selectedFlavourPrice[$toursKey] = $this->flavour[$toursKey][$firstDetailKey]['price'] ?? 0;

        $this->selectedFlavourNights[$toursKey] = $this->flavour[$toursKey][$firstDetailKey]['nights'] ?? 0;
    }

    private function getFilterDestination($tour, $toursKey)
    {
        $this->filter_destinations_ids[] = explode(',', $tour->destination);
    }
    private function getFilterThemes($tour, $toursKey)
    {

        $this->filter_themes_ids[] = explode(',', $tour->categories);
    }

    public function selectedflavour($value, $index)
    {
        foreach ($this->flavour[$index] as $flavour) {
            // dd($flavour);
            if ($flavour['tour_type_id'] == $value) {
                $this->selectedFlavour[$index] = $flavour;
                $this->selectedFlavourPrice[$index] = $flavour['price'];
                $this->selectedFlavourNights[$index] = $flavour['nights'];
            }
        }
    }

    public function validationAttributes()
    {
        return [
            'title' => 'Title',
            'f_name' => 'First Name',
            'l_name' => 'Last Name',
            'mob_num' => 'Mobile Number',
            'email_id' => 'Email',
            'country_id' => 'Country',
            'city_id' => 'City',
            'travel_date' => 'Travel Date',
            'destination' => 'Destination',
            'adults' => 'Adults',
            'children' => 'Children',
            'infants' => 'Infants',
            'remarks' => 'Remarks',
            'userInput' => 'Captcha',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        $validated['full_name'] = $this->full_name;
        $validated['unique_id'] = Helper::generateUniqueId();
        $randomStaff = Staff::where('role_id', 5)->inRandomOrder()->first();
        $validated['support_team'] = $randomStaff->id;
        $validated['status'] = 1;

        unset($validated['f_name']);
        unset($validated['l_name']);

        if ($validated) {
            $tourcallusback =  TourCallUsBack::create($validated);
            // Mail::to($randomStaff->email)->cc('joddhajitputel143@gmail.com')->send(new TourCallUsBackInquiryEmail($tourcallusback, $randomStaff));

            session()->flash('international_tour', 'Your Inquiry Number is <strong style="color: blue;">' . Helper::uppercase($validated['unique_id']) . '</strong>' .
                ' and <strong style="color: blue;">' . $randomStaff->first_name . ' ' . $randomStaff->last_name . '</strong>' .
                ' has been assigned this query.<br> They will call you soon.');
            $this->dispatch('reload-page');
            // $this->reset();
        }
    }
    public function generateCaptcha()
    {
        $text = Str::random(6); // Generate random text for CAPTCHA
        $image = imagecreatetruecolor(120, 40); // Create a blank image

        // Set colors
        $background_color = imagecolorallocate($image, 255, 255, 255); // White background
        $text_color = imagecolorallocate($image, 0, 0, 0); // Black text color

        // Fill image with background color
        imagefilledrectangle($image, 0, 0, 120, 40, $background_color);

        // Add random lines to make CAPTCHA harder to read for bots
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $text_color);
        }

        // Add text to image
        imagettftext($image, 20, 0, 10, 30, $text_color, public_path('css/fonts/nunito-v9-latin-600.ttf'), $text);

        // Output the image as base64
        ob_start();
        imagepng($image);
        $this->captchaImage = base64_encode(ob_get_clean());
        imagedestroy($image);

        // Store CAPTCHA code in session
        session(['captcha_code' => $text]);
    }


    #[Layout('user.layouts.app')]
    public function render()
    {
        return view('user.pages.int-tour-listing-component');
    }
}
