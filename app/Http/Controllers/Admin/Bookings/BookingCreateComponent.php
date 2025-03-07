<?php

namespace App\Http\Controllers\Admin\Bookings;

use App\Helpers\Helper;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Agency;
use App\Models\ServiceType;
use App\Models\SharingType;
use App\Models\PackageType;
use App\Models\City;
use App\Models\Pnr;
use App\Models\VisaCategory;
use App\Models\VisaDetails;
use App\Models\PackageMaster;
use App\Models\Packages;
use App\Models\PackageDetails;
use App\Models\HotelMaster;
use App\Models\Booking;
use App\Models\Country;
use Carbon\Carbon;

class BookingCreateComponent extends Component
{
    use LivewireAlert;

    public $agencies, $serviceType, $cities, $months, $pnrList = [], $sharingType, $packageType, $packageMaster, $visaCat, $countries, $hotels;
    public $service_type_id, $city_id, $month_id, $pnr_id, $pkg_days, $pkg_name_id, $pax_name = '', $adult_count, $cwb_count, $cwob_count, $infant_count, $total_pax, $total_beds, $total_seats, $country_id, $checkin_date, $checkout_date, $email_id, $contact, $tot_cost, $cost_breakup, $special_request, $number_of_nights;
    public $agency_id, $pkg_type_id, $pkg_type_ids, $travel_date, $sharing_type_id, $flight_details, $visa_type_id, $hotel_id1, $number_rooms, $hotel_id;
    
    public $pkg_adult_price,$pkg_child_with_bed_price,$pkg_child_no_bed_price,$pkg_infant_price,$selected_pnr;
    public $tkt_adult_price,$tkt_childprice;
    public $tot_pkg_cost,$tot_ticket_cost;
    public $visa_rate,$tot_visa_price;
    public function mount()
    {
        $this->agencies = Agency::active()->orderBy('agency_name', 'ASC')->get();
        $this->serviceType = ServiceType::active()->get();
        $this->cities = City::active()->get();
        $this->months = Helper::months();
        $this->sharingType = SharingType::active()->get();
        // $this->packageType = PackageType::active()->get();
        $this->packageMaster = Packages::active()->get();
        $this->countries = Country::active()->get();
        $this->hotels = HotelMaster::active()->get();
    }

    public function packageDetialsChange()
    {

    }

    public function getPnrList()
    {
        $today = Carbon::today()->format('Y-m-d');
        $currentMonth = Carbon::parse($today)->format('m');

        $query = Pnr::query();

        $query->where(function ($query) {
            $query->where('pnr_pack_type', 'Non-Saleable')
                ->orWhere('pnr_pack_type', 'Both');
        })
            ->where('dept_date', '>', $today)
            ->where('avai_seats', '>', 0);

        if ($this->month_id) {
            $query->whereMonth('dept_date', $this->month_id);
        }

        if ($this->city_id) {
            $query->where('dept_city_id', $this->city_id);
        }

        $this->pnrList = $query->with('flight')->get();


    }

    public function getPkgDays()
    {

        $this->selected_pnr = Pnr::findOrFail($this->pnr_id);
        $this->pkg_days = $this->selected_pnr->days;
        $this->travel_date = $this->selected_pnr->dept_date;

    }

    public function getPackageRates()
    {   
        // dd($this->pkg_name_id , $this->pkg_type_id , $this->sharing_type_id);
        if ($this->pkg_name_id && $this->pkg_type_id && $this->sharing_type_id) {

            if($this->sharing_type_id == 1)
            $sharing_rate = 'd_share';
            if($this->sharing_type_id == 2)
            $sharing_rate = 't_share';
            if($this->sharing_type_id == 3)
            $sharing_rate = 'qd_share';
            if($this->sharing_type_id == 4)
            $sharing_rate = 'g_share';
            if($this->sharing_type_id == 5)
            $sharing_rate = 'qt_share';
            if($this->sharing_type_id == 6)
            $sharing_rate = 'single';
            


            $pkg_prices = PackageDetails::where('pkg_id',$this->pkg_name_id)->where('pkg_type_id',$this->pkg_type_id)->first();
            $this->pkg_adult_price = $pkg_prices->$sharing_rate;
            $this->pkg_child_with_bed_price = $pkg_prices->child_with_bed;
            $this->pkg_child_no_bed_price = $pkg_prices->chlid_no_bed;
            $this->pkg_infant_price = $pkg_prices->infant;

            $ticket_prices = Pnr::where('id',$this->pnr_id)->first();
            $this->tkt_adult_price  = $ticket_prices->adult_cost;
            $this->tkt_childprice   = $ticket_prices->child_cost;

            $visa_prices = VisaDetails::where('country_id',3)->where('visa_id',3)->first();
            $this->visa_rate  = $visa_prices->visa_price;
           
        }
    }



    public function getAllCounts()
    {
        $this->total_pax = (int) $this->adult_count + (int) $this->cwb_count + (int) $this->cwob_count + (int) $this->infant_count;
        $this->total_beds = (int) $this->adult_count + (int) $this->cwb_count;
        $this->total_seats = (int) $this->adult_count + (int) $this->cwb_count + (int) $this->cwob_count;

        
        $this->tot_pkg_cost = [
            'Adult' => $this->adult_count * $this->pkg_adult_price,
            'Child with Bed' => $this->cwb_count * $this->pkg_child_with_bed_price,
            'Child without Bed' => $this->cwob_count * $this->pkg_child_no_bed_price,
            'Infant' => $this->infant_count * $this->pkg_infant_price,
        ];

        $this->tot_pkg_cost = array_sum($this->tot_pkg_cost);  

        $this->tot_ticket_cost = [
            'Adult' => $this->adult_count *  $this->tkt_adult_price,
            'Child' => ($this->cwb_count + $this->cwob_count) * $this->tkt_childprice,            
        ];
        $this->tot_ticket_cost = array_sum($this->tot_ticket_cost);  

        $this->tot_visa_price = $this->visa_rate * $this->total_pax;

        

        $this->tot_cost = $this->tot_pkg_cost + $this->tot_ticket_cost +  $this->tot_visa_price ;

        $this->cost_breakup ="Package Price =  $this->adult_count (Adults) X $this->pkg_adult_price + $this->cwb_count (CWB) X $this->pkg_child_with_bed_price + $this->cwob_count (CNB) X $this->pkg_child_no_bed_price + $this->infant_count (Infant) X $this->pkg_infant_price = $this->tot_pkg_cost \nTicket Price = $this->adult_count (Adults) X $this->tkt_adult_price + ".$this->cwb_count + $this->cwob_count." (Child) X $this->tkt_childprice = $this->tot_ticket_cost \nVisa Price = $this->total_pax (Total Pax) X $this->visa_rate = $this->tot_visa_price \nTotal Cost = $this->tot_cost";
        
        // $this->cost_breakup ="Package Price =  $this->adult_count (Adults) X $this->pkg_adult_price + $this->cwb_count (CWB) X $this->pkg_child_with_bed_price + $this->cwob_count (CNB) X $this->pkg_child_no_bed_price + $this->infant_count (Infant) X $this->pkg_infant_price = $this->tot_pkg_cost \nTicket Price = $this->adult_count (Adults) X $this->tkt_adult_price + ".$this->cwb_count + $this->cwob_count." (Child) X $this->tkt_childprice = $this->tot_ticket_cost \nVisa Price = $this->total_pax (Total Pax) X $this->visa_rate = $this->tot_visa_price \nTotal Cost = ".number_format($this->tot_cost,2);

        // $this->cost_breakup ="Package Price = $this->pkg_adult_price,for Child with Bed = $this->pkg_child_with_bed_price,for Child without Bed = $this->pkg_child_no_bed_price,for Infant = $this->pkg_infant_price \n";

        // $this->cost_breakup = "Adult = $this->adult_count * Package rate for adult $this->pkg_adult_price = ". $this->adult_count * $this->pkg_adult_price."\n";
    }

    public function getPkgType()
    {   
        // dd($this->pkg_name_id,$this->sharing_type_id);
        $this->packageType = PackageDetails::with('packageType', 'makkahotel', 'madinahotel', 'mealType', 'laundrytype')->where('pkg_id', $this->pkg_name_id)->get();
        // dd($this->pkg_name_id , $this->pkg_type_id , $this->sharing_type_id);

    }

    public function getVisaType()
    {
        $this->visaCat = VisaCategory::where('countryid', $this->country_id)->get();
    }

    public function getDateDiffDays()
    {
        if ($this->checkin_date && $this->checkout_date) {
            $startDate = Carbon::createFromFormat('Y-m-d', $this->checkin_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $this->checkout_date);
            $this->number_of_nights = intval($startDate->diffInDays($endDate)) . ' Nights';
        }
    }

    public function save()
    {
        $last_booking = Booking::latest()->first();
        $validated = $this->validate([
            'agency_id' => 'required',
            'service_type_id' => 'required',
        ], [
            'agency_id.required' => 'Please select an agency Type',
            'service_type_id.required' => 'Please Select a service Type',
        ]);


        if ($this->service_type_id == 2 || $this->service_type_id == 6 || $this->service_type_id == 8 || $this->service_type_id == 10) {
            $validated = $this->validate([
                'agency_id' => 'required',
                'service_type_id' => 'required',
                'city_id' => 'required',
                'month_id' => 'required',
                'pnr_id' => 'required',
                'pkg_name_id' => 'required',
                'pkg_type_id' => 'required',
                'sharing_type_id' => 'required',
                'pkg_days' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',
                'cost_breakup' => 'required',


            ], [
                'agency_id.required' => 'Please select an agency Type',
                'service_type_id.required' => 'Please Select a service Type',
                'city_id.required' => 'Please select city',
                'pnr_id.required' => 'Please select a PNR',
                'pkg_name_id.required' => 'Please select a package',
                'month_id.required' => 'Please select a month',
                'pkg_type_id.required' => 'Please select a package type',
                'sharing_type_id.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'cost_breakup.required' => 'Please enter the cost breakup',

            ]);


            $data = [
                // 'booking_id' => $last_booking->booking_id + 1,
                'agency_id' => $validated['agency_id'],
                'service_type' => $validated['service_type_id'],
                'city_id' => $validated['city_id'],
                'days' => $validated['pkg_days'],
                'pnr_id' => $validated['pnr_id'],
                'travel_date' => $this->travel_date,
                'package_type' => $validated['pkg_type_id'],
                'shairing_type' => $validated['sharing_type_id'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $validated['cost_breakup'],
                'special_request' => $this->special_request ?? '',
            ];

            Booking::create($data);
            $this->alert('success', 'Successfully Added');
            return redirect()->route('admin.booking.index');
        } elseif ($this->service_type_id == 11) {
            $validated = $this->validate([
                'agency_id' => 'required',
                'service_type_id' => 'required',
                'city_id' => 'required',
                'month_id' => 'required',
                'pnr_id' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required',
                'contact' => 'required',
                'tot_cost' => 'required',
                'cost_breakup' => 'required',

            ]);

            $dept_date = Pnr::select('dept_date')->where('id', $this->pnr_id)->first();
            $data = [
                // 'request_id' => $last_booking->booking_id + 1,
                // 'booking_id' => $last_booking->booking_id + 1,
                'agency_id' => $validated['agency_id'],
                'service_type' => $validated['service_type_id'],
                'city_id' => $validated['city_id'],
                'travel_date' => $dept_date->dept_date,
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $validated['cost_breakup'],
                'special_request' => $this->special_request ?? '',
            ];
            Booking::create($data);
            $this->alert('success', 'Successfully Added');
            return redirect()->route('admin.booking.index');
        } elseif ($this->service_type_id == 12) {



            $validated = $this->validate([

                'agency_id' => 'required',
                'service_type_id' => 'required',
                'country_id' => 'required',
                'travel_date' => 'required',
                'visa_type_id' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required',
                'contact' => 'required',
                'tot_cost' => 'required',
                'cost_breakup' => 'required',

            ]);

            $data = [
                // 'booking_id' => $last_booking->booking_id + 1,
                'agency_id' => $validated['agency_id'],
                'service_type' => $validated['service_type_id'],
                'country_id' => $validated['country_id'],
                'travel_date' => $validated['travel_date'],
                'visa_type_id' => $validated['visa_type_id'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $validated['cost_breakup'],
                'special_request' => $this->special_request ?? '',
            ];
            Booking::create($data);
            $this->alert('success', 'Successfully Added');
            return redirect()->route('admin.booking.index');
        } elseif ($this->service_type_id == 13) {
            // dd($this->checkin_date);
            $validated = $this->validate([

                'agency_id' => 'required',
                'service_type_id' => 'required',
                'hotel_id' => 'required',
                'checkin_date' => 'required',
                'checkout_date' => 'required',
                'number_of_nights' => 'required',
                'number_rooms' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required',
                'contact' => 'required',
                'tot_cost' => 'required',
                'cost_breakup' => 'required',

            ], [
                'agency_id.required' => 'Please select an agency Type',
                'service_type_id.required' => 'Please Select a service Type',
                'checkin_date.required' => 'Please select checkin date',
                'checkout_date.required' => 'Please select checkout date',
                'pnr_id.required' => 'Please select a PNR',
                'pkg_name_id.required' => 'Please select a package',
                'month_id.required' => 'Please select a month',
                'pkg_type_id.required' => 'Please select a package type',
                'sharing_type_id.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'cost_breakup.required' => 'Please enter the cost breakup',
                'hotel_id' => 'Please select a hotel',

            ]);

            $data = [
                // 'booking_id' => $last_booking->booking_id + 1,
                'agency_id' => $validated['agency_id'],
                'service_type' => $validated['service_type_id'],
                'hotel_id' => $validated['hotel_id'],
                'checkin_date' => $validated['checkin_date'],
                'checkout_date' => $validated['checkout_date'],
                'nights' => $validated['number_of_nights'],
                'rooms' => $validated['number_rooms'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $validated['cost_breakup'],
                'special_request' => $this->special_request ?? '',
            ];
        } else {

            $validated = $this->validate([
                'agency_id' => 'required',
                'service_type_id' => 'required',
                'city_id' => 'required',
                'travel_date' => 'required',
                'pkg_type_ids' => 'required',
                'sharing_type_id' => 'required',
                'pkg_days' => 'required',
                'flight_details' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',
                'cost_breakup' => 'required',


            ], [
                'agency_id.required' => 'Please select an agency Type',
                'service_type_id.required' => 'Please Select a service Type',
                'city_id.required' => 'Please select city',
                'pnr_id.required' => 'Please select a PNR',
                'pkg_name_id.required' => 'Please select a package',
                'month_id.required' => 'Please select a month',
                'pkg_type_ids.required' => 'Please select a package type',
                'sharing_type_id.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'cost_breakup.required' => 'Please enter the cost breakup',
                'flight_details.required' => 'Please enter flight details',
                'travel_date.required' => 'Please enter travel date',

            ]);

            $data = [
                // 'booking_id' => $last_booking->booking_id + 1,
                'agency_id' => $validated['agency_id'],
                'service_type' => $validated['service_type_id'],
                'city_id' => $validated['city_id'],
                'days' => $validated['pkg_days'],
                'travel_date' => $validated['travel_date'],
                'package_type' => $validated['pkg_type_ids'],
                'shairing_type' => $validated['sharing_type_id'],
                'flight_details' => $validated['flight_details'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $validated['cost_breakup'],
                'special_request' => $this->special_request ?? '',
            ];

        }
        Booking::create($data);
        $this->alert('success', 'Booking Added Successfully');
        return redirect()->route('admin.booking.index');

    }

    public function render()
    {
        return view('admin.bookings.booking-create-component');
    }
}
