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
use App\Models\HotelMaster;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Packages;
use Carbon\Carbon;

class BookingEditComponent extends Component
{
    use LivewireAlert;
    public $agencies, $serviceType, $cities, $months, $pnrList = [], $sharingType, $packageType, $packageMaster, $visaCat, $countries, $hotels;
    public $booking, $booking_id, $service_type, $city_id, $month_id, $pnr_id, $pkg_days, $pkg_name_id, $pax_name = '', $adult_count, $cwb_count, $cwob_count, $infant_count, $total_pax, $total_beds, $total_seats, $country_id, $checkin_date, $checkout_date, $email_id, $contact, $tot_cost, $cost_breakup, $special_request, $number_of_nights;

    public $agency_id, $pkg_type_id, $travel_date, $sharing_type_id, $get_pnr, $visa_type_id, $status_desc, $created_at, $updated_at, $booking_status_id, $flight_details, $hotel_id, $number_rooms;

    public function mount(Booking $booking_id)
    {

        $this->booking = $booking_id;
        // dd($this->booking->package->umrah_type);
        $this->booking_id       = $booking_id->id;
        $this->agencies         = Agency::desc()->get();
        $this->serviceType      = ServiceType::get();
        $this->cities           = City::get();
        $this->months           = Helper::months();
        $this->sharingType      = SharingType::get();
        $this->packageType      = PackageType::get();
        $this->packageMaster    = Packages::get();

        $this->flight_details   = $booking_id->flight_details;
        $this->countries        = Country::get();
        $this->hotels           = HotelMaster::get();

        $this->pkg_days         = $booking_id->days;
        $this->hotel_id         = $booking_id->hotel_id;

        $this->checkin_date     = $booking_id->checkin_date;
        $this->checkout_date    = $booking_id->checkout_date;
        $this->number_of_nights = $booking_id->nights;
        $this->number_rooms     = $booking_id->rooms;

        $this->agency_id        = $booking_id->agency_id;
        $this->service_type     = $booking_id->service_type;
        $this->city_id          = $booking_id->city_id;
        $this->month_id         = Carbon::parse($booking_id->travel_date)->format('m');

        // dd($this->month_id);
        $this->pnrList          = Pnr::where('id', $booking_id->pnr_id)->get();
        $this->status_desc      = $booking_id->status_desc;

        if ($booking_id->pnr_id != '' && $booking_id->pnr_id != 0) {
            $this->pnr_id       =  $booking_id->pnr_id;
            $this->get_pnr      = Pnr::findorfail($this->pnr_id);
            $this->pkg_days     = $this->get_pnr->days;
            $this->getPkgDays();
        }

        $this->travel_date      = $booking_id->travel_date;
        // $this->travel_date == '05-08-2024';

        // dd($this->travel_date);
        if ($booking_id->service_type == 12) {
            $this->country_id   = $booking_id->country_id;
            $this->travel_date  = $booking_id->travel_date;
            $this->visaCat      = VisaCategory::where('countryid', $this->country_id)->get();
            $this->visa_type_id = $booking_id->visa_type_id;
        }

        if ($this->month_id) {
            $this->getPnrList();
            $this->pnr_id       = $booking_id->pnr_id;
        }



        $this->pkg_name_id      = $booking_id->package_name;
        $this->pkg_type_id      = $booking_id->package_type;
        //    dd($this->pkg_name_id, $this->pkg_type_id);
        $this->sharing_type_id  = $booking_id->shairing_type;
        $this->pax_name         = $booking_id->mehram_name;
        $this->adult_count      = $booking_id->adult;
        $this->cwb_count        = $booking_id->child_bed;

        $this->cwob_count       = $booking_id->child;
        $this->infant_count     = $booking_id->infant;
        $this->email_id         = $booking_id->email_id;
        $this->contact          = $booking_id->contact;
        $this->tot_cost         = $booking_id->tot_cost;
        $this->cost_breakup     = $booking_id->cost_breackup;
        $this->special_request  = $booking_id->special_request;
        $this->status_desc      = $booking_id->status_desc;
        $this->created_at       = Helper::appDateTimeFormat($booking_id->created_at);
        $this->updated_at       = Helper::appDateTimeFormat($booking_id->updated_at);
        $this->booking_status_id = $booking_id->booking_status;
        $this->getAllCounts();
        //  dd($this->cost_breakup);
        //  dd($this->pnr_id);

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

        // Add conditions based on $monthdate
        if ($this->month_id) {
            $query->whereMonth('dept_date', $this->month_id);
        }
        // Add condition based on $dept_city
        if ($this->city_id) {
            $query->where('dept_city_id', $this->city_id);
        }
        // Retrieve the results
        $this->pnrList = $query->get();

        // dd($this->pnrList);
    }

    public function getTotalPkgPrice()
    {

        $pkg_price = PackageMaster::where('package_name', $this->pkg_name_id);
    }

    public function packageDetialsChange()
    {
        //  dd($this->service_type);
    }
    public function getPkgDays()
    {

        $get_pnr = Pnr::findorfail($this->pnr_id);
        $this->pkg_days = $get_pnr->days;
    }

    public function getAllCounts()
    {
        $this->total_pax    = $this->adult_count + $this->cwb_count + $this->cwob_count + $this->infant_count;

        $this->total_beds   = $this->adult_count + $this->cwb_count;

        $this->total_seats  = $this->adult_count + $this->cwb_count + $this->cwob_count;
    }

    public function update()
    {
        //   dd($this->service_type);
        if ($this->service_type == 2 || $this->booking->package->umrah_type == 1) {   //Umrah
            //   dd('umrah');
            $validated = $this->validate([
                'agency_id'         => 'required',
                'service_type'      => 'required',
                'city_id'           => 'required',
                'month_id'          => 'required',
                'pnr_id'            => 'required',
                'pax_name'          => 'required',
                'sharing_type_id'   => 'required',
                'adult_count'       => 'required',
                'email_id'          => 'required',
                'contact'           => 'required',
                'tot_cost'          => 'required',
                'cost_breakup'      => 'required',
                'booking_status_id' => 'required',

            ], [
                'agency_id.required'        => 'Please select an agency Type',
                'service_type.required'     => 'Please Select a service Type',
                'city_id.required'          => 'Please select city',
                'month_id.required'         => 'Please select a month',
                'pnr_id.required'           => 'Please select a PNR',
                'pax_name.required'         => 'Please enter passenger name',
                'sharing_type_id.required'  => 'Please select a sharing type',
                'adult_count.required'      => 'Please enter number of adult name',
                'email_id.required'         => 'Please enter an email address',
                'email_id.email'            => 'Please enter a valid email address',
                'contact.required'          => 'Please enter a contact number',
                'tot_cost.required'         => 'Please enter total cost amount',
                'cost_breakup.required'     => 'Please enter the cost breakup',
            ]);

            $dept_date = Pnr::select('dept_date')->where('id', $this->pnr_id)->first();
            $data = [
                'agency_id'         =>  $validated['agency_id'],
                'service_type'      =>  $validated['service_type'],
                'city_id'           =>  $validated['city_id'],
                'travel_date'       =>  $dept_date->dept_date,
                'package_name'      =>  $this->pkg_name_id,
                'package_type'      =>  $this->pkg_type_id,
                'shairing_type'     =>  $validated['sharing_type_id'],
                'mehram_name'        =>  $validated['pax_name'],
                'adult'                =>  $validated['adult_count'],
                'child_bed'            =>  $this->cwb_count,
                'child'             =>  $this->cwob_count,
                'infant'            =>  $this->infant_count,
                'email_id'          =>  $validated['email_id'],
                'contact'           =>  $validated['contact'],
                'tot_cost'          =>  $validated['tot_cost'],
                'cost_breackup'     =>  $validated['cost_breakup'],
                'special_request'   =>  $this->special_request ?? '',
                'booking_status'    =>  $validated['booking_status_id'],
                'status_desc'       =>  $this->status_desc,
                'pnr_id'            =>  $validated['pnr_id'],
            ];
            // dd($data);
            $booking = Booking::find($this->booking_id);
            $totalpax = $booking->adult + $booking->child_bed + $booking->child;
            if ($booking) {
                $booking->update($data);
                if ($validated['booking_status_id'] == 3) {
                    $available_seat = Pnr::whereId($booking->pnr_id)->first();
                    // dd($available_seat);
                    if ($available_seat) {
                        $available_seat->update(['avai_seats' => $available_seat->avai_seats + $totalpax]);
                    }
                }

                $this->alert('success', 'Successfully Updated');
                return redirect()->route('admin.booking.index');
            } else {
                $this->alert('error', 'Booking not found');
            }
        } else if ($this->service_type == 11) {    // Group Ticket

            $validated = $this->validate([
                'agency_id'         => 'required',
                'service_type'      => 'required',
                'city_id'           => 'required',
                'month_id'          => 'required',
                'pnr_id'            => 'required',
                'pax_name'          => 'required',
                'adult_count'       => 'required',
                'email_id'          => 'required',
                'contact'           => 'required',
                'tot_cost'          => 'required',
                'cost_breakup'      => 'required',
                'booking_status_id' => 'required',

            ]);

            $dept_date = Pnr::select('dept_date')->where('id', $this->pnr_id)->first();
            $data = [
                'agency_id'         =>  $validated['agency_id'],
                'service_type'      =>  $validated['service_type'],
                'city_id'           =>  $validated['city_id'],
                'travel_date'       =>  $dept_date->dept_date,
                'mehram_name'        =>  $validated['pax_name'],
                'adult'                =>  $validated['adult_count'],
                'child_bed'            =>  $this->cwb_count,
                'child'             =>  $this->cwob_count,
                'infant'            =>  $this->infant_count,
                'email_id'          =>  $validated['email_id'],
                'contact'           =>  $validated['contact'],
                'tot_cost'          =>  $validated['tot_cost'],
                'cost_breackup'     =>  $validated['cost_breakup'],
                'special_request'   =>  $this->special_request ?? '',
                'booking_status'    =>  $validated['booking_status_id'],
                'status_desc'       =>  $this->status_desc,
                'pnr_id'            =>  $validated['pnr_id'],
            ];

            $booking = Booking::find($this->booking_id);

            if ($booking) {
                $booking->update($data);
                $this->alert('success', 'Successfully Updated');
                return redirect()->route('admin.booking.index');
            } else {
                $this->alert('error', 'Booking not found');
            }
        } else if ($this->service_type == 12) {    // Visa Only
            $validated = $this->validate([

                'agency_id'         => 'required',
                'service_type'      => 'required',
                'country_id'        => 'required',
                'travel_date'       => 'required',
                'visa_type_id'      => 'required',
                'pax_name'          => 'required',
                'adult_count'       => 'required',
                'email_id'          => 'required',
                'contact'           => 'required',
                'tot_cost'          => 'required',
                'cost_breakup'      => 'required',
                'booking_status_id' => 'required',

            ]);

            $data = [

                'agency_id'         =>  $validated['agency_id'],
                'service_type'      =>  $validated['service_type'],
                'country_id'        =>  $validated['country_id'],
                'travel_date'       =>  $validated['travel_date'],
                'visa_type_id'      =>  $validated['visa_type_id'],
                'mehram_name'        =>  $validated['pax_name'],
                'adult'                =>  $validated['adult_count'],
                'child_bed'            =>  $this->cwb_count,
                'child'             =>  $this->cwob_count,
                'infant'            =>  $this->infant_count,
                'email_id'          =>  $validated['email_id'],
                'contact'           =>  $validated['contact'],
                'tot_cost'          =>  $validated['tot_cost'],
                'cost_breackup'     =>  $validated['cost_breakup'],
                'special_request'   =>  $this->special_request ?? '',
                'booking_status'    =>  $validated['booking_status_id'],
                'status_desc'       =>  $this->status_desc
            ];
        } else if ($this->service_type == 13) {    //Hotels
            $validated = $this->validate([

                'agency_id'         => 'required',
                'service_type'      => 'required',
                'hotel_id'          => 'required',
                'checkin_date'      => 'required',
                'checkout_date'     => 'required',
                'number_of_nights'  => 'required',
                'number_rooms'      => 'required',
                'pax_name'          => 'required',
                'adult_count'       => 'required',
                'email_id'          => 'required',
                'contact'           => 'required',
                'tot_cost'          => 'required',
                'cost_breakup'      => 'required',
                'booking_status_id' => 'required',

            ], [
                'agency_id.required'        => 'Please select an agency Type',
                'service_type.required'     => 'Please Select a service Type',
                'checkin_date.required'     => 'Please select checkin date',
                'checkout_date.required'    => 'Please select checkout date',
                'pnr_id.required'           => 'Please select a PNR',
                'pkg_name_id.required'      => 'Please select a package',
                'month_id.required'         => 'Please select a month',
                'pkg_type_ids.required'     => 'Please select a package type',
                'sharing_type_id.required'  => 'Please select a sharing type',
                'pax_name.required'         => 'Please enter passenger name',
                'adult_count.required'      => 'Please enter number of adult name',
                'pkg_days.required'         => 'Please enter number of days',
                'email_id.required'         => 'Please enter an email address',
                'email_id.email'            => 'Please enter a valid email address',
                'contact.required'          => 'Please enter a contact number',
                'tot_cost.required'         => 'Please enter total cost amount',
                'cost_breakup.required'     => 'Please enter the cost breakup',
                'hotel_id'                  => 'Please select a hotel',

            ]);

            $data = [

                'agency_id'         =>  $validated['agency_id'],
                'service_type'      =>  $validated['service_type'],
                'hotel_id'          =>  $validated['hotel_id'],
                'checkin_date'      =>  $validated['checkin_date'],
                'checkout_date'     =>  $validated['checkout_date'],
                'nights'            =>  $validated['number_of_nights'],
                'rooms'             =>  $validated['number_rooms'],
                'mehram_name'        =>  $validated['pax_name'],
                'adult'                =>  $validated['adult_count'],
                'child_bed'            =>  $this->cwb_count,
                'child'             =>  $this->cwob_count,
                'infant'            =>  $this->infant_count,
                'email_id'          =>  $validated['email_id'],
                'contact'           =>  $validated['contact'],
                'tot_cost'          =>  $validated['tot_cost'],
                'cost_breackup'     =>  $validated['cost_breakup'],
                'special_request'   =>  $this->special_request ?? '',
                'booking_status'    =>  $validated['booking_status_id'],
                'status_desc'       =>  $this->status_desc
            ];
        } else {
            $validated = $this->validate([
                'agency_id'             => 'required',
                'service_type'          => 'required',
                'city_id'               => 'required',
                'travel_date'           => 'required',
                'pkg_type_id'           => 'required',
                'sharing_type_id'       => 'required',
                'pkg_days'              => 'required',
                'flight_details'        => 'required',
                'pax_name'              => 'required',
                'adult_count'           => 'required',
                'email_id'              => 'required|email',
                'contact'               => 'required',
                'tot_cost'              => 'required',
                'cost_breakup'          => 'required',
                'booking_status_id'     => 'required',


            ], [
                'agency_id.required'        => 'Please select an agency Type',
                'service_type_id.required'  => 'Please Select a service Type',
                'city_id.required'          => 'Please select city',
                'pnr_id.required'           => 'Please select a PNR',
                'pkg_name_id.required'      => 'Please select a package',
                'month_id.required'         => 'Please select a month',
                'pkg_type_id.required'      => 'Please select a package type',
                'sharing_type_id.required'  => 'Please select a sharing type',
                'pax_name.required'         => 'Please enter passenger name',
                'adult_count.required'      => 'Please enter number of adult',
                'pkg_days.required'         => 'Please enter number of days',
                'email_id.required'         => 'Please enter an email address',
                'email_id.email'            => 'Please enter a valid email address',
                'contact.required'          => 'Please enter a contact number',
                'tot_cost.required'         => 'Please enter total cost amount',
                'cost_breakup.required'     => 'Please enter the cost breakup',
                'flight_details.required'   => 'Please enter flight details',
                'travel_date.required'      => 'Please enter travel date',

            ]);

            $data = [

                'agency_id'         =>  $validated['agency_id'],
                'service_type'      =>  $validated['service_type'],
                'city_id'           =>  $validated['city_id'],
                'days'              =>  $validated['pkg_days'],
                'travel_date'       =>  $validated['travel_date'],
                'package_type'      =>  $validated['pkg_type_id'],
                'shairing_type'     =>  $validated['sharing_type_id'],
                'flight_details'    =>  $validated['flight_details'],
                'mehram_name'        =>  $validated['pax_name'],
                'adult'                =>  $validated['adult_count'],
                'child_bed'            =>  $this->cwb_count,
                'child'             =>  $this->cwob_count,
                'infant'            =>  $this->infant_count,
                'email_id'          =>  $validated['email_id'],
                'contact'           =>  $validated['contact'],
                'tot_cost'          =>  $validated['tot_cost'],
                'cost_breackup'     =>  $validated['cost_breakup'],
                'special_request'   =>  $this->special_request ?? '',
                'booking_status'    =>  $validated['booking_status_id'],
                'status_desc'       =>  $this->status_desc
            ];
        }

        $booking = Booking::find($this->booking_id);
        if ($booking) {
            $booking->update($data);
            $this->alert('success', 'Successfully Updated');
            return redirect()->route('admin.booking.index');
        } else {
            $this->alert('error', 'Booking not found');
        }
    }
    public function render()
    {

        return view('admin.bookings.booking-edit-component');
    }
}
