<?php

namespace App\Http\Controllers\Agent\Quotes;

use Livewire\Attributes\Layout;
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
use App\Models\Membership;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;
use App\Models\AdminSetting;
use App\Models\KitCategory;
use App\Models\Services;


class QuotesCreateComponent extends Component
{
    use LivewireAlert;

    public $agent, $agencies, $serviceType, $cities, $months, $pnrList = [], $sharingType, $packageType = [], $packageMaster, $visaCat, $countries, $hotels;
    public $service_type_id, $city_id, $month_id, $pnr_id, $pkg_days, $pkg_name_id, $pax_name = '', $adult_count, $cwb_count, $cwob_count, $infant_count, $total_pax, $total_beds, $total_seats, $country_id, $checkin_date, $checkout_date, $email_id, $contact, $tot_cost, $cost_breakup, $agent_cost_breakup, $special_request, $number_of_nights;
    public $agency_id, $pkg_type_id_umrah,$pkg_type_id_hajj, $travel_date, $sharing_type_id, $flight_details, $visa_type_id, $hotel_id1, $number_rooms, $hotel_id;
    public $umrah_type_id;
    public $pkg_adult_price, $pkg_child_with_bed_price, $pkg_child_no_bed_price, $pkg_infant_price, $selected_pnr;
    public $tkt_adult_price, $tkt_childprice, $tkt_infant_price;
    public $tot_pkg_cost, $tot_ticket_cost, $commissions, $tot_pkg_commission;
    public $visa_rate, $tot_visa_price, $pkg_name_id_umrah, $pkg_name_id_hajj, $sharing_type_id_umrah, $sharing_type_id_hajj, $city_id_hajj, $pkg_days_hajj;
    public $other_services,$hajj_kits,$hajj_kit_id,$service_details,$services,$service_value;
    public function mount()
    {
        $this->agencies = Agency::active()->orderBy('agency_name', 'ASC')->get();


        $this->serviceType = ServiceType::get();

        $this->cities = City::active()->get();
        $this->months = Helper::months();
        $this->sharingType = SharingType::active()->get();
        // $this->packageMaster = Packages::active()->get();
        $this->countries = Country::active()->get();
        $this->hotels = HotelMaster::active()->get();
        $this->agent = auth()->user();
        $this->commissions = Membership::find($this->agent->membership);
    }

    public function packageDetialsChange()
    {
        if($this->service_type_id == 26){
            $this->hajj_kits = KitCategory::Active()->where('category_id',1)->get();
        }


        if($this->service_type_id == 27){
            $this->services = Services::Active()->get();
        }

        if ($this->service_type_id == 2 ) {
            $this->packageMaster = Packages::active()->where('service_id', $this->service_type_id)->where('umrah_type', $this->umrah_type_id)->get();
        } else {
                $this->packageMaster = Packages::active()->where('service_id', $this->service_type_id)->get();
        }
        if($this->service_type_id != 26){
            $this->reset(['hajj_kits', 'hajj_kit_id']);
        }
        if($this->service_type_id != 27){
            $this->reset(['services', 'hajj_kit_id']);
        }

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
            $query->whereMonth('dept_date', (int) $this->month_id);
        }

        if ($this->city_id) {
            $query->where('dept_city_id', $this->city_id);
        }

        $this->pnrList = $query->with('flight')->get();
    }

    public function getHajjPackages()
    {

    }

    public function getPkgDays()
    {

        $pnr = Pnr::whereId($this->pnr_id)->first();
        $this->selected_pnr = Pnr::findOrFail($this->pnr_id);
        $this->pkg_days = $this->selected_pnr->days;
        $this->travel_date = $this->selected_pnr->dept_date;
        $packIds = explode(',',$pnr->pack_id);
        $this->packageMaster = Packages::active()->whereIn('id',$packIds)->get();

    }


    public function getPkgTypeUmrah()
    {

        if ($this->pkg_name_id_umrah) {
            $this->packageType = PackageDetails::with('packageType', 'makkahotel', 'madinahotel', 'mealType', 'laundrytype')->where('pkg_id', $this->pkg_name_id_umrah)->get();
        }
    }

    public function getsharingTypeUmrah()
    {
        // dd($this->pkg_type_id, $this->pnr_id);
        if ($this->pkg_name_id_umrah && $this->pkg_type_id_umrah) {

            $pkg_detail = PackageDetails::where('pkg_id', $this->pkg_name_id_umrah)->where('pkg_type_id', $this->pkg_type_id_umrah)->first();

            $sharing_ids = [];

            if ($pkg_detail->g_share != 0) {
                array_push($sharing_ids, 4);
            }
            if ($pkg_detail->qt_share != 0) {
                array_push($sharing_ids, 5);
            }
            if ($pkg_detail->qd_share != 0) {
                array_push($sharing_ids, 3);
            }
            if ($pkg_detail->t_share != 0) {
                array_push($sharing_ids, 2);
            }
            if ($pkg_detail->d_share != 0) {
                array_push($sharing_ids, 1);
            }
            if ($pkg_detail->single != 0) {
                array_push($sharing_ids, 6);
            }
            $this->sharingType = SharingType::whereIn('id', $sharing_ids)->get();
        }

    }

    public function getsharingTypeHajj()
    {
        if ($this->pkg_name_id_hajj && $this->pkg_type_id_hajj) {
            $pkg_detail = PackageDetails::where('pkg_id', $this->pkg_name_id_hajj)->where('pkg_type_id', $this->pkg_type_id_hajj)->first();

            $sharing_ids = [];

            if ($pkg_detail->g_share != 0) {
                array_push($sharing_ids, 4);
            }
            if ($pkg_detail->qt_share != 0) {
                array_push($sharing_ids, 5);
            }
            if ($pkg_detail->qd_share != 0) {
                array_push($sharing_ids, 3);
            }
            if ($pkg_detail->t_share != 0) {
                array_push($sharing_ids, 2);
            }
            if ($pkg_detail->d_share != 0) {
                array_push($sharing_ids, 1);
            }
            if ($pkg_detail->single != 0) {
                array_push($sharing_ids, 6);
            }
            $this->sharingType = SharingType::whereIn('id', $sharing_ids)->get();
        }
    }

    public function getPkgTypeHajj()
    {
        if ($this->pkg_name_id_hajj) {
            $this->packageType = PackageDetails::with('packageType', 'mealType', 'laundrytype')->where('pkg_id', $this->pkg_name_id_hajj)->get();
        }
    }

    public function getPackageRatesUmrah()
    {
        if ($this->pkg_name_id_umrah && $this->pkg_type_id_umrah && $this->sharing_type_id_umrah) {

            if ($this->sharing_type_id_umrah == 1)
                $sharing_rate = 'd_share';
            if ($this->sharing_type_id_umrah == 2)
                $sharing_rate = 't_share';
            if ($this->sharing_type_id_umrah == 3)
                $sharing_rate = 'qd_share';
            if ($this->sharing_type_id_umrah == 4)
                $sharing_rate = 'g_share';
            if ($this->sharing_type_id_umrah == 5)
                $sharing_rate = 'qt_share';
            if ($this->sharing_type_id_umrah == 6)
                $sharing_rate = 'single';

            $pkg_prices = PackageDetails::where('pkg_id', $this->pkg_name_id_umrah)->where('pkg_type_id', $this->pkg_type_id_umrah)->first();

            $this->pkg_adult_price = $pkg_prices->$sharing_rate;
            $this->pkg_child_with_bed_price = $pkg_prices->child_with_bed;
            $this->pkg_child_no_bed_price = $pkg_prices->chlid_no_bed;
            $this->pkg_infant_price = $pkg_prices->infant;

            $ticket_prices = Pnr::where('id', $this->pnr_id)->first();
            $this->tkt_adult_price = $ticket_prices->adult_cost;
            $this->tkt_childprice = $ticket_prices->child_cost;
            $this->tkt_infant_price = $ticket_prices->infant_cost;
            $visa_prices = VisaDetails::where('country_id', 3)->where('visa_id', 3)->first();

            $this->visa_rate = $visa_prices->visa_price;
        }
    }

    public function getPackageRatesHajj()
    {
        if ($this->pkg_name_id_hajj && $this->pkg_type_id_hajj && $this->sharing_type_id_hajj) {

            if ($this->sharing_type_id_hajj == 1)
                $sharing_rate = 'd_share';
            if ($this->sharing_type_id_hajj == 2)
                $sharing_rate = 't_share';
            if ($this->sharing_type_id_hajj == 3)
                $sharing_rate = 'qd_share';
            if ($this->sharing_type_id_hajj == 4)
                $sharing_rate = 'g_share';
            if ($this->sharing_type_id_hajj == 5)
                $sharing_rate = 'qt_share';
            if ($this->sharing_type_id_hajj == 6)
                $sharing_rate = 'single';

            $pkg_prices = PackageDetails::where('pkg_id', $this->pkg_name_id_hajj)->where('pkg_type_id', $this->pkg_type_id_hajj)->first();

            $this->pkg_adult_price = $pkg_prices->$sharing_rate;
            $this->pkg_child_with_bed_price = $pkg_prices->child_with_bed;
            $this->pkg_child_no_bed_price = $pkg_prices->chlid_no_bed;
            $this->pkg_infant_price = $pkg_prices->infant;
        }
    }
    public function getAllCounts()
    {
        $this->infant_count = $this->infant_count == "" ? 0 : $this->infant_count;
        $this->cwob_count = $this->cwob_count == "" ? 0 : $this->cwob_count;
        $this->cwb_count = $this->cwb_count == "" ? 0 : $this->cwb_count;
        $this->adult_count = $this->adult_count == "" ? 0 : $this->adult_count;

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
            'Adult' => $this->adult_count * $this->tkt_adult_price,
            'Child' => ($this->cwb_count + $this->cwob_count) * $this->tkt_childprice,
            'Infant' => $this->infant_count * $this->tkt_infant_price,
        ];

        $this->tot_ticket_cost = array_sum($this->tot_ticket_cost);

        $this->tot_visa_price = $this->visa_rate * $this->total_pax;

        if($this->service_type_id != 12 && $this->service_type_id != 22 && $this->service_type_id != 23 && $this->service_type_id != 24 && $this->service_type_id != 25 && $this->service_type_id != 26 && $this->service_type_id != 27){
            if ($this->service_type_id == 2) {

                // $user_cost = $this->tot_pkg_cost + $this->tot_ticket_cost + $this->tot_visa_price;
                $user_cost = $this->tot_pkg_cost;
                // $this->tot_cost = $this->tot_pkg_cost + $this->tot_ticket_cost + $this->tot_visa_price - $this->tot_pkg_commission;
                $this->tot_cost = $this->tot_pkg_cost - $this->tot_pkg_commission;
                // $this->cost_breakup = "Package Price = " . $this->adult_count . " (Adults) X " . number_format($this->pkg_adult_price,2) . " + " . $this->cwb_count . " (CWB) X " . number_format($this->pkg_child_with_bed_price,2) . " + " . $this->cwob_count . " (CNB) X " . number_format($this->pkg_child_no_bed_price,2) . " + " . $this->infant_count . " (Infant) X " . number_format($this->pkg_infant_price,2) . " = " . number_format($this->tot_pkg_cost,2) .
                // "\nTicket Price = " . $this->adult_count . " (Adults) X " . number_format($this->tkt_adult_price,2) . " + " . $this->cwb_count + $this->cwob_count . " (Child) X " . number_format($this->tkt_childprice,2) . " + " . $this->infant_count . " (Infant) X " . number_format($this->tkt_infant_price,2) . " = " . number_format($this->tot_ticket_cost,2) .
                // "\nVisa Price = " . $this->total_pax . " (Total Pax) X " . number_format($this->visa_rate,2) . " = " . number_format($this->tot_visa_price,2) .
                // "\nTotal Cost = " . number_format($user_cost,2) . " \n\n";

                $this->cost_breakup = "Package Price = " . $this->adult_count . " (Adults) X " . number_format($this->pkg_adult_price, 2) . " + " . $this->cwb_count . " (CWB) X " . number_format($this->pkg_child_with_bed_price, 2) . " + " . $this->cwob_count . " (CNB) X " . number_format($this->pkg_child_no_bed_price, 2) . " + " . $this->infant_count . " (Infant) X " . number_format($this->pkg_infant_price, 2) . " = " . number_format($this->tot_pkg_cost, 2) . " \n\n";

                // Agent Cost Calculation
                //     $adult_commission = (int) $this->adult_count * $this->commissions->adult_commision;
                //     $child_commission = (int) ($this->cwb_count + $this->cwob_count) * $this->commissions->chlid_commision;
                //     $infant_commission = (int) $this->infant_count * $this->commissions->infant_commision;
                //     $this->tot_pkg_commission = $adult_commission + $child_commission + $infant_commission;
                //     // dd($adult_commission,$child_commission,$infant_commission,$tot_pkg_commission);
                //     $this->agent_cost_breakup = "Package Price = (" .
                //         (number_format((int) $this->adult_count * $this->pkg_adult_price,2)) . " - " .
                //         (number_format($adult_commission,2)) . ") + (" .
                //         (number_format((int) ($this->cwb_count + $this->cwob_count) * $this->pkg_child_with_bed_price,2)) . " - " .
                //         (number_format($child_commission,2)) . ") + (" .
                //         (number_format((int) $this->infant_count * $this->pkg_infant_price,2)) . " - " .
                //         (number_format($infant_commission,2)) . ") = " . number_format($this->tot_pkg_cost - $this->tot_pkg_commission,2);

                //     $this->agent_cost_breakup .= "\nTicket Price = " . number_format( $this->tot_ticket_cost,2);

                //     $this->agent_cost_breakup .= "\nVisa Price = " . number_format( $this->tot_visa_price,2);

                //     $this->agent_cost_breakup .= "\nTotal Cost = " . number_format($this->tot_pkg_cost - $this->tot_pkg_commission +  $this->tot_ticket_cost +  $this->tot_visa_price,2);

                //    $this->tot_cost = floatval($this->tot_pkg_cost + $this->tot_ticket_cost + $this->tot_visa_price - $this->tot_pkg_commission);

                $adult_commission = (int) $this->adult_count * $this->commissions->adult_commision;
                $child_commission = (int) ($this->cwb_count + $this->cwob_count) * $this->commissions->chlid_commision;
                $infant_commission = (int) $this->infant_count * $this->commissions->infant_commision;
                $this->tot_pkg_commission = $adult_commission + $child_commission + $infant_commission;
                // dd($adult_commission,$child_commission,$infant_commission,$tot_pkg_commission);
                $this->agent_cost_breakup = "Package Price = (" .
                    (number_format((int) $this->adult_count * $this->pkg_adult_price, 2)) . " - " .
                    (number_format($adult_commission, 2)) . ") + (" .
                    (number_format(($this->cwb_count * $this->pkg_child_with_bed_price) + ($this->cwob_count * $this->pkg_child_no_bed_price), 2)) . " - " .
                    (number_format($child_commission, 2)) . ") + (" .
                    (number_format((int) $this->infant_count * $this->pkg_infant_price, 2)) . " - " .
                    (number_format($infant_commission, 2)) . ") = " . number_format($this->tot_pkg_cost - $this->tot_pkg_commission, 2);

                // $this->agent_cost_breakup .= "\nTicket Price = " . number_format( $this->tot_ticket_cost,2);

                // $this->agent_cost_breakup .= "\nVisa Price = " . number_format( $this->tot_visa_price,2);

                $this->agent_cost_breakup .= "\nTotal Cost = " . number_format($this->tot_pkg_cost - $this->tot_pkg_commission, 2);

                $this->tot_cost = floatval($this->tot_pkg_cost - $this->tot_pkg_commission);
            } else {
                // $this->tot_cost = $this->tot_pkg_cost;
                $this->cost_breakup = "Package Price = " .
                    floatval($this->adult_count) . " (Adults) X " . number_format(floatval($this->pkg_adult_price), 2) . " + " .
                    floatval($this->cwb_count) . " (CWB) X " . number_format(floatval($this->pkg_child_with_bed_price), 2) . " + " .
                    floatval($this->cwob_count) . " (CNB) X " . number_format(floatval($this->pkg_child_no_bed_price), 2) . " + " .
                    floatval($this->infant_count) . " (Infant) X " . number_format(floatval($this->pkg_infant_price), 2) . " = " .
                    number_format(floatval($this->tot_pkg_cost), 2);


                $adult_commission = (int) $this->adult_count * $this->commissions->adult_commision;
                $child_commission = (int) ($this->cwb_count + $this->cwob_count) * $this->commissions->chlid_commision;
                $infant_commission = (int) $this->infant_count * $this->commissions->infant_commision;
                $this->tot_pkg_commission =  $adult_commission + $child_commission + $infant_commission;

                // $this->agent_cost_breakup = "Package Price = (" .
                //     number_format($this->adult_count * $this->pkg_adult_price, 2) . " - " .
                //     number_format($adult_commission, 2) . ") + (" .
                //     number_format(($this->cwb_count + $this->cwob_count) * $this->pkg_child_with_bed_price, 2) . " - " .
                //     number_format($child_commission, 2) . ") + (" .
                //     number_format($this->infant_count * $this->pkg_infant_price, 2) . " - " .
                //     number_format($infant_commission, 2) . ") = " .
                //     number_format($this->tot_pkg_cost - $this->tot_pkg_commission, 2);


                $this->agent_cost_breakup = "Package Price = (" .
                    number_format($this->adult_count * $this->pkg_adult_price, 2) . " - " .
                    number_format($adult_commission, 2) . ") + (" .
                    number_format(($this->cwb_count * $this->pkg_child_with_bed_price) + ($this->cwob_count * $this->pkg_child_no_bed_price), 2) . " - " .
                    number_format($child_commission, 2) . ") + (" .
                    number_format($this->infant_count * $this->pkg_infant_price, 2) . " - " .
                    number_format($infant_commission, 2) . ") = " .
                    number_format($this->tot_pkg_cost - $this->tot_pkg_commission, 2);

                $this->tot_cost = $this->tot_pkg_cost - $this->tot_pkg_commission;
            }
        }

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
        $last_request = Booking::desc()->first();

        if (!$last_request) {
            $new_request = 10001;
        } else {
            $new_request = $last_request->request_id + 1;
        }

        $validated = $this->validate([

            'service_type_id' => 'required',
        ], [

            'service_type_id.required' => 'Please Select a service Type',
        ]);

        if ($this->service_type_id == 12 || $this->service_type_id == 22 || $this->service_type_id == 23 || $this->service_type_id == 24 || $this->service_type_id == 25){


            $validated = $this->validate([
                'service_type_id' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required|numeric|min:1.00',

            ], [

                'service_type_id.required' => 'Please Select a service Type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'tot_cost.min' => 'The total cost must be greater than 0',
            ]);

            $data = [

                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'service_details' => $this->service_details,

            ];

            Booking::create($data);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            Mail::to($this->agent->email)->cc('biswajitadas15@gmail.com')->send(new BookingConfirmationMail($data, $adminSetting, $adminwhatsapp));

            // Mail::to($this->agent->email)->cc($adminEmail)->send(new BookingConfirmationMail($data));
            $this->alert('success', 'Successfully Added');
            return redirect()->route('agent.quotes.index');
        }
        if ($this->service_type_id == 26){
            $validated = $this->validate([
                'service_type_id' => 'required',
                'hajj_kit_id' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',

            ], [

                'service_type_id.required' => 'Please select a service Type',
                'hajj_kit_id.required' => 'Please select a Kit',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
            ]);

            $data = [

                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'hajj_kit_id' => $validated['hajj_kit_id'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'service_details' => $this->service_details,

            ];

            Booking::create($data);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            Mail::to($this->agent->email)->cc('biswajitadas15@gmail.com')->send(new BookingConfirmationMail($data, $adminSetting, $adminwhatsapp));
            // Mail::to($this->agent->email)->cc($adminEmail)->send(new BookingConfirmationMail($data));
            $this->alert('success', 'Successfully Added');
            return redirect()->route('agent.quotes.index');
        }
        if ($this->service_type_id == 27){
            // dd($this->service_type_id,$this->service_value,$this->pax_name,$this->adult_count,$this->email_id,$this->contact,$this->tot_cost);
            $validated = $this->validate([
                'service_type_id' => 'required',
                'service_value' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',

            ], [

                'service_type_id.required' => 'Please select a service Type',
                'service_value.required' => 'Please select a Kit',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
            ]);

            $data = [

                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'service_value' => $validated['service_value'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'service_details' => $this->service_details,

            ];

            Booking::create($data);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';

            // Mail::to($this->agent->email)->cc($adminEmail)->send(new BookingConfirmationMail($data));
            $this->alert('success', 'Successfully Added');
            return redirect()->route('agent.quotes.index');
        }



        if (($this->service_type_id == 2 && $this->umrah_type_id == 1) || ($this->service_type_id == 20)) {

            if ($this->umrah_type_id) {
                $validate = $this->validate([
                    'umrah_type_id' => 'required',
                ], [

                    'umrah_type_id.required' => 'Please Select Umrah Type',

                ]);
                $data = ['umrah_type'  => $validate['umrah_type_id']];
            }

            $validated = $this->validate([

                'service_type_id' => 'required',
                'city_id' => 'required',
                'month_id' => 'required',
                'pnr_id' => 'required',
                'pkg_name_id_umrah' => 'required',
                'pkg_type_id_umrah' => 'required',
                'sharing_type_id_umrah' => 'required',
                'pkg_days' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',

            ], [

                'service_type_id.required' => 'Please select a service Type',
                'city_id.required' => 'Please select city',
                'pnr_id.required' => 'Please select a PNR',
                'pkg_name_id_umrah.required' => 'Please select a package',
                'month_id.required' => 'Please select a month',
                'pkg_type_id_umrah.required' => 'Please select a package type',
                'sharing_type_id_umrah.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult name',
                'pkg_days.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',



            ]);
            $data = [

                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'umrah_type' => $validate['umrah_type_id'] ?? null,
                'city_id' => $validated['city_id'],
                'days' => $validated['pkg_days'],
                'pnr_id' => $validated['pnr_id'],
                'travel_date' => $this->travel_date,
                'package_name' => $validated['pkg_name_id_umrah'],
                'package_type' => $validated['pkg_type_id_umrah'],
                'shairing_type' => $validated['sharing_type_id_umrah'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_user_cost' => $validated['tot_cost'] + $this->tot_pkg_commission,
                'tot_cost' => $validated['tot_cost'],
                'cost_breackup' => $this->cost_breakup,
                'agent_cost_breackup' => $this->agent_cost_breakup,
                'special_request' => $this->special_request ?? '',
            ];

            Booking::create($data);
            $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
            $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
            $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
            $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
            Mail::to($this->agent->email)->cc('biswajitadas15@gmail.com')->send(new BookingConfirmationMail($data, $adminSetting, $adminwhatsapp));

            // Mail::to($this->agent->email)->cc($adminEmail)->send(new BookingConfirmationMail($data));
            $this->alert('success', 'Successfully Added');
            return redirect()->route('agent.quotes.index');
        }
        if($this->service_type_id == 2 && $this->umrah_type_id == 2) {
            if ($this->umrah_type_id) {
                $validate = $this->validate([
                    'umrah_type_id' => 'required',
                ], [

                    'umrah_type_id.required' => 'Please Select Umrah Type',

                ]);
                $data = ['umrah_type'  => $validate['umrah_type_id']];
            }

            $validated = $this->validate([

                'service_type_id' => 'required',
                // 'city_id_hajj' => 'required',
                'pkg_name_id_hajj' => 'required',
                'pkg_type_id_hajj' => 'required',
                'travel_date' => 'required',
                'sharing_type_id_hajj' => 'required',
                'pkg_days_hajj' => 'required',
                // 'flight_details' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',
                // 'cost_breakup' => 'required',

            ], [

                'service_type_id.required' => 'Please Select a service Type',
                // 'city_id_hajj.required' => 'Please select city',
                'pkg_name_id_hajj.required' => 'Please select a package',
                'pkg_type_id_hajj.required' => 'Please select a package type',
                'sharing_type_id_hajj.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult',
                'pkg_days_hajj.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'cost_breakup.required' => 'Please enter the cost breakup',
                // 'flight_details.required' => 'Please enter flight details',
                'travel_date.required' => 'Please enter travel date',

            ]);


            $data = [
                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'umrah_type' => $validate['umrah_type_id'] ?? null,
                // 'city_id' => $validated['city_id_hajj'],
                'days' => $validated['pkg_days_hajj'],
                'travel_date' => $validated['travel_date'],
                'package_name' => $validated['pkg_name_id_hajj'],
                'package_type' => $validated['pkg_type_id_hajj'],
                'shairing_type' => $validated['sharing_type_id_hajj'],
                // 'flight_details' => $validated['flight_details'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'tot_user_cost' => $validated['tot_cost'] + $this->tot_pkg_commission,
                'cost_breackup' => $this->cost_breakup,
                'agent_cost_breackup' => $this->agent_cost_breakup,
                'special_request' => $this->special_request ?? '',
            ];

        }else {



            if ($this->umrah_type_id) {
                $validate = $this->validate([
                    'umrah_type_id' => 'required',
                ], [

                    'umrah_type_id.required' => 'Please Select Umrah Type',

                ]);
                $data = ['umrah_type'  => $validate['umrah_type_id']];
            }

            $validated = $this->validate([

                'service_type_id' => 'required',
                // 'city_id_hajj' => 'required',
                'pkg_name_id_hajj' => 'required',
                'pkg_type_id_hajj' => 'required',
                'travel_date' => 'required',
                'sharing_type_id_hajj' => 'required',
                'pkg_days_hajj' => 'required',
                'flight_details' => 'required',
                'pax_name' => 'required',
                'adult_count' => 'required',
                'email_id' => 'required|email',
                'contact' => 'required',
                'tot_cost' => 'required',
                // 'cost_breakup' => 'required',

            ], [

                'service_type_id.required' => 'Please Select a service Type',
                // 'city_id_hajj.required' => 'Please select city',
                'pkg_name_id_umrah.required' => 'Please select a package',
                'pkg_type_id_umrah.required' => 'Please select a package type',
                'sharing_type_id_hajj.required' => 'Please select a sharing type',
                'pax_name.required' => 'Please enter passenger name',
                'adult_count.required' => 'Please enter number of adult',
                'pkg_days_hajj.required' => 'Please enter number of days',
                'email_id.required' => 'Please enter an email address',
                'email_id.email' => 'Please enter a valid email address',
                'contact.required' => 'Please enter a contact number',
                'tot_cost.required' => 'Please enter total cost amount',
                'cost_breakup.required' => 'Please enter the cost breakup',
                'flight_details.required' => 'Please enter flight details',
                'travel_date.required' => 'Please enter travel date',

            ]);


            $data = [
                'request_id' => $new_request,
                'agency_id' => $this->agent->id,
                'service_type' => $validated['service_type_id'],
                'umrah_type' => $validate['umrah_type_id'] ?? null,
                // 'city_id' => $validated['city_id_hajj'],
                'days' => $validated['pkg_days_hajj'],
                'travel_date' => $validated['travel_date'],
                'package_name' => $validated['pkg_name_id_hajj'],
                'package_type' => $validated['pkg_type_id_hajj'],
                'shairing_type' => $validated['sharing_type_id_hajj'],
                'flight_details' => $validated['flight_details'],
                'mehram_name' => $validated['pax_name'],
                'adult' => $validated['adult_count'],
                'child_bed' => $this->cwb_count,
                'child' => $this->cwob_count,
                'infant' => $this->infant_count,
                'email_id' => $validated['email_id'],
                'contact' => $validated['contact'],
                'tot_cost' => $validated['tot_cost'],
                'tot_user_cost' => $validated['tot_cost'] + $this->tot_pkg_commission,
                'cost_breackup' => $this->cost_breakup,
                'agent_cost_breackup' => $this->agent_cost_breakup,
                'special_request' => $this->special_request ?? '',
            ];
        }

        Booking::create($data);
        $adminEmailSetting = AdminSetting::where('parameter_name', 'Admin Email')->first();
        $adminEmail = $adminEmailSetting ? $adminEmailSetting->parameter_value : 'info@rahat.com';
        $adminSetting=AdminSetting::where('id', 1)->value('parameter_value');
        $adminwhatsapp=AdminSetting::where('id', 2)->value('parameter_value');
        Mail::to($this->agent->email)->cc('biswajitadas15@gmail.com')->send(new BookingConfirmationMail($data, $adminSetting, $adminwhatsapp));
        // Mail::to($this->agent->email)->cc($adminEmail)->send(new BookingConfirmationMail($data));
        $this->alert('success', 'Request Sent Successfully');
        return redirect()->route('agent.quotes.index');
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.quotes.quotes-create-component');
    }
}
