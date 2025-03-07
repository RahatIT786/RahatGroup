<?php

namespace App\Http\Controllers\Staff;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\CallUsBack;
use App\Models\Umrah;
use App\Models\TourCallUsBack;
use App\Models\TouristVisa;
use App\Models\Laundry;
use App\Models\HotelEnquiries;
use App\Models\PublicationEnquiry;
use App\Models\ForexEnquiry;
use App\Models\Bookingenquiry;
use App\Models\ShoppingEnquiry;
use App\Models\HajjKitEnquiry;
use App\Models\FoodEnquiry;
use App\Models\Booking;
use App\Models\Packages;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardComponent extends Component
{
   public $totalEnquiryUmrah,$acceptedEnquiryUmrah,$rejectedEnquiryUmrah,$totaltourcallusback,$totaltouracceptecallusback,$rejectedtourcallusback;
   public $totalcallusback,$totalacceptecallusback,$rejectedcallusback,$totalacceptetouristvisa,$totaltouristvisa,$rejectedtouristvisa,$acceptedCount,$totalEnquiries,$rejectedCount;
   public $acceptedhotelenquiries,$hotelenquiries,$rejecthotelenquiries,$forexenquiry,$acceptedforexenquiry,$rejectforexenquiry,$totallaundry,$totalacceptelaundry,$rejectedlaundry,$acceptedbookingenquiry,$bookingenquiry,$rejectbookingenquiry,$shoppingenquiry,$rejectshoppingenquiry,$acceptedshoppingenquiry,$acceptedhajjKitenquiry,$hajjKitenquiry,$rejecthajjKitenquiry,$acceptedfoodenquiry,$foodenquiry,$rejectfoodenquiry;
   public $agents_counts,$active_agents_counts,$inactive_agents_counts,$tot_booking_requests,$tot_confirmed_bookings,$tot_Pending_bookings,$topFivePackages_ids,$topFivePackages, $bookingByServiceType = [];
   public $user_count,$active_user_count,$inactive_user_count,$confirmed_payments,$pending_payments,$bookingShare,$packagesByServiceType;
   public function mount()
    {
        // Count of accepted enquiries
        $this->acceptedCount = PublicationEnquiry::where('status', 2)->count();
        $this->totalEnquiries = PublicationEnquiry::where('status', 1)->count();
        $this->rejectedCount = PublicationEnquiry::where('status', 3)->count();

        $this->totalacceptelaundry = Laundry::where('status', 2)->count();
        $this->totallaundry = Laundry::where('status', 1)->count();
        $this->rejectedlaundry = Laundry::where('status', 3)->count();

        // $this->totaltouracceptecallusback = TourCallUsBack::where('status', 2)->count();
        // $this->totaltourcallusback = TourCallUsBack::where('status', 1)->count();
        // $this->rejectedtourcallusback = TourCallUsBack::where('status', 3)->count();

        $this->totalacceptetouristvisa = TouristVisa::where('status', 2)->count();
        $this->totaltouristvisa = TouristVisa::where('status', 1)->count();
        $this->rejectedtouristvisa = TouristVisa::where('status', 3)->count();

        $this->totalEnquiryUmrah = Umrah::where('status', 1)->count();
        $this->acceptedEnquiryUmrah = Umrah::where('status', 2)->count();
        $this->rejectedEnquiryUmrah = Umrah::where('status', 3)->count();

          $this->totaltouracceptecallusback = TourCallUsBack::where('status', 2)->count();
        $this->totaltourcallusback = TourCallUsBack::where('status', 1)->count();
         $this->rejectedtourcallusback = TourCallUsBack::where('status', 3)->count();

          $this->totalacceptecallusback = CallUsBack::where('status', 2)->count();
        $this->totalcallusback = CallUsBack::where('status', 1)->count();
        $this->rejectedcallusback = CallUsBack::where('status', 3)->count();


        $this->acceptedhotelenquiries = HotelEnquiries::where('status', 2)->count();
        $this->hotelenquiries = HotelEnquiries::where('status', 1)->count();
        $this->rejecthotelenquiries = HotelEnquiries::where('status', 3)->count();

        $this->acceptedforexenquiry = ForexEnquiry::where('status', 2)->count();
        $this->forexenquiry = ForexEnquiry::where('status', 1)->count();
        $this->rejectforexenquiry = ForexEnquiry::where('status', 3)->count();

        $this->acceptedbookingenquiry = Bookingenquiry::where('status', 2)->count();
        $this->bookingenquiry = Bookingenquiry::where('status', 1)->count();
        $this->rejectbookingenquiry = Bookingenquiry::where('status', 3)->count();

        $this->acceptedshoppingenquiry = ShoppingEnquiry::where('status', 2)->count();
        $this->shoppingenquiry = ShoppingEnquiry::where('status', 1)->count();
        $this->rejectshoppingenquiry = ShoppingEnquiry::where('status', 3)->count();

        $this->acceptedhajjKitenquiry = HajjKitEnquiry::where('status', 2)->count();
        $this->hajjKitenquiry = HajjKitEnquiry::where('status', 1)->count();
        $this->rejecthajjKitenquiry = HajjKitEnquiry::where('status', 3)->count();
        $this->acceptedfoodenquiry = FoodEnquiry::where('status', 2)->count();
        $this->foodenquiry = FoodEnquiry::where('status', 1)->count();
        $this->rejectfoodenquiry = FoodEnquiry::where('status', 3)->count();

        $agents = Agent::where('rm_staff_id', auth()->user()->id)->pluck('id');
        $this->agents_counts = Agent::where('rm_staff_id', auth()->user()->id)->count();
        $this->active_agents_counts =Agent::Active()->where('rm_staff_id', auth()->user()->id)->count();
        $this->inactive_agents_counts = Agent::where('is_active',0)->where('rm_staff_id', auth()->user()->id)->count();
        

        $this->user_count = Customer::where('rm_staff_id', auth()->user()->id)->count();
        $this->active_user_count = Customer::Active()->where('rm_staff_id', auth()->user()->id)->count();
        $this->inactive_user_count = Customer::where('is_active',0)->where('rm_staff_id', auth()->user()->id)->count();


        $booking_query = Booking::whereIn('agency_id',$agents);

        $booking_ids = $booking_query->pluck('id');

        $this->confirmed_payments = Payment::whereIn('id',$booking_ids)->where('is_paid',1)->sum('amount');
        $this->pending_payments = Payment::whereIn('id',$booking_ids)->where('is_paid',0)->sum('amount');

        $this->tot_booking_requests = $booking_query->count();
        $this->tot_confirmed_bookings = $booking_query->approved()->count();
        $this->tot_Pending_bookings = $booking_query->pending()->count();


        $this->topFivePackages_ids = Booking::query()
        ->select('package_name', DB::raw('COUNT(*) as booking_count'))
        ->groupBy('package_name')
        ->orderByDesc('booking_count')
        ->take(5)
        ->pluck('package_name')->toArray();
       $this->topFivePackages = $this->getPopularPackages();
        
       $this->bookingByServiceType['months'] = $this->getPreviousMonths(5);
       $this->bookingByServiceType['data'] = $this->getServiceByMonth();
       $this->bookingShare[] =  array_sum($this->bookingByServiceType['data']['hajj']);
       $this->bookingShare[] =  array_sum($this->bookingByServiceType['data']['umrah']);
       $this->bookingShare[] =  array_sum($this->bookingByServiceType['data']['ramzan']);
       $this->bookingShare[] =  array_sum($this->bookingByServiceType['data']['ziarat']);

       $this->packagesByServiceType = $this->getPackagesByServiceType();
       
    //    dd( $this->bookingShare);
    }

    public function getPackagesByServiceType()
    {
        // Join the packages table with the service_type table and group by service_type name
        $packages = DB::table('aihut_packages')
            ->join('aihut_service_type', 'aihut_packages.service_id', '=', 'aihut_service_type.id')
            ->select('aihut_service_type.name as service_type_name', DB::raw('COUNT(aihut_packages.id) as count'))
            ->groupBy('aihut_service_type.name')
            ->get();

        // Optionally, you can format the result as an array of service type names and counts
        $result = [
            'service_type_names' => $packages->pluck('service_type_name')->toArray(),
            'counts' => $packages->pluck('count')->toArray(),
        ];

        return $result;
    }

    public function getPopularPackages()
    {
        $query = Packages::query();
        if ($this->topFivePackages_ids) {
            $query->whereIn('id', $this->topFivePackages_ids);
        }
        return $query->get();
    }

    public function getPreviousMonths($count = 8)
    {
        $months = [];
        $currentMonth = Carbon::now();
      
        for ($i = 1; $i <= $count; $i++) {
            $months[$count - $i + 1] = $currentMonth->format('F'); // Get the current month first
            $currentMonth->subMonth(); // Then subtract one month for the next iteration
        }
        // return $months;
        return array_reverse($months, true);
    }

    public function getServiceByMonth()
    {
        $bookings = [];
       
        foreach ($this->bookingByServiceType['months'] as $month) {
            $hajj[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 1)->count();
            $umrah[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 2)->count();
            $ramzan[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 20)->count();
            $ziarat[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 21)->count();

            $hajj_sales[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 1)->sum('tot_user_cost');
            $umrah_sales[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 2)->sum('tot_user_cost');
            $ramzan_sales[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 20)->sum('tot_user_cost');
            $ziarat_sales[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 21)->sum('tot_user_cost');
        }
        $bookings['hajj'] = $hajj;
        $bookings['umrah'] = $umrah;
        $bookings['ramzan'] = $ramzan;
        $bookings['ziarat'] = $ziarat;
        
        $bookings['hajj_sales'] = $hajj_sales;
        $bookings['umrah_sales'] = $umrah_sales;
        $bookings['ramzan_sales'] = $ramzan_sales;
        $bookings['ziarat_sales'] = $ziarat_sales;
        return $bookings;
    }

    #[Layout('staff.layouts.app')]
    public function render()
    {
        // $enquiries = PublicationEnquiry::where('status', 2)->get();
        // $callusback = CallUsBack::where('status', 2)->get();
        // $Touristvisa = TouristVisa::where('status', 2)->get();
        // $tourcallusback = TourCallUsBack::where('status', 2)->get();

        return view('staff.dashboard-component', [
            'totalEnquiryUmrah' => $this->totalEnquiryUmrah,
            'acceptedEnquiryUmrah' => $this->acceptedEnquiryUmrah,
            'rejectedEnquiryUmrah' => $this->rejectedEnquiryUmrah,
            'totaltourcallusback' => $this->totaltourcallusback,
            'totaltouracceptecallusback' => $this->totaltouracceptecallusback,
            'rejectedtourcallusback' => $this->rejectedtourcallusback,
            'totalacceptecallusback'  => $this->totalacceptecallusback,
            'totalcallusback'  => $this->totalcallusback,
            'rejectedcallusback'  => $this->rejectedcallusback,
            'totalacceptetouristvisa'  => $this->totalacceptetouristvisa,
            'totaltouristvisa'  => $this->totaltouristvisa,
            'rejectedtouristvisa'  => $this->rejectedtouristvisa,

            'acceptedhotelenquiries'  => $this->acceptedhotelenquiries,
            'hotelenquiries'  => $this->hotelenquiries,
            'rejecthotelenquiries'  => $this->rejecthotelenquiries,

            'acceptedforexenquiry'  => $this->acceptedforexenquiry,
            'forexenquiry'  => $this->forexenquiry,
            'rejectforexenquiry'  => $this->rejectforexenquiry,
            'totallaundry' => $this->totallaundry,
            'totalacceptelaundry' => $this->totalacceptelaundry,
            'rejectedlaundry' => $this->rejectedlaundry,
            'acceptedbookingenquiry' => $this->acceptedbookingenquiry,
            'bookingenquiry' => $this->bookingenquiry,
            'rejectbookingenquiry' => $this->rejectbookingenquiry,
            'shoppingenquiry' => $this->shoppingenquiry,
            'acceptedshoppingenquiry' => $this->acceptedshoppingenquiry,
            'rejectshoppingenquiry' => $this->rejectshoppingenquiry,
            'acceptedhajjKitenquiry' => $this->acceptedhajjKitenquiry,
            'hajjKitenquiry' => $this->hajjKitenquiry,
            'rejecthajjKitenquiry' => $this->rejecthajjKitenquiry,
            'acceptedfoodenquiry' => $this->acceptedfoodenquiry,
            'foodenquiry' => $this->foodenquiry,
            'rejectfoodenquiry' => $this->rejectfoodenquiry,

        ]);
    }
}
