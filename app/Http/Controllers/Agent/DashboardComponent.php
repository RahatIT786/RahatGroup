<?php

namespace App\Http\Controllers\Agent;

use App\Helpers\Helper;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Booking;
use App\Models\Bookingenquiry;
use App\Models\Payment;
use App\Models\Packages;
use DB;

use Carbon\Carbon;

class DashboardComponent extends Component
{
    public $current_agent, $all_bookings;

    public $quotes, $confirmed_bookings, $requests;
    public $payment, $booking_ids = [], $requestQuotes, $packages;

    public $inqBookings = [], $bookingShare, $topPackages, $packagesByServiceType, $bookingByServiceType = [], $paymentsByMonth = [];

    public function mount()
    {
        $agentId =  auth()->user()->id;

        $today = Carbon::today();
        $bookings = Booking::query()
            ->where('agency_id', auth()->user()->id)
            ->orderBy('id', 'ASC')
            ->paid()
            ->get();

        foreach ($bookings as $booking) {
            $givenDate = Carbon::parse($booking->travel_date); // Replace with your date
            if ($givenDate->greaterThan($today) && $booking->admin_active == false) {
                $daysDifference = $today->diffInDays($givenDate);
                if ($daysDifference < 3) {
                    $booking->update([
                        'is_active' => false
                    ]);
                }else{
                    $booking->update([
                        'is_active' => true
                    ]);
                }
            }
        }

        $this->inqBookings['months'] = $this->getPreviousMonths();
        $this->inqBookings['quotes'] = $this->getQuotesCount();
        $this->inqBookings['bookings'] = $this->getBookings();
        $this->bookingShare = $this->getBookingShare();
        $this->packagesByServiceType = $this->getPackagesByServiceType();
        $this->bookingByServiceType['months'] = $this->getPreviousMonths(5);
        $this->bookingByServiceType['data'] = $this->getServiceByMonth();


        $this->paymentsByMonth['months'] = $this->getPreviousMonths(7);
        $this->paymentsByMonth['data'] = $this->getPaymentByMonth();


        // dd($this->paymentsByMonth);


    }

    public function getPreviousMonths($count = 8)
    {
        $months = [];
        $currentMonth = Carbon::now();
        // $startOfYear = Carbon::now()->startOfYear(); // Start from January

        // $count = $currentMonth->month - $startOfYear->month + 1;

        // Ensure $count is a positive integer and valid
        // $count = max(1, $count);
        // $count = 8;
        // dd($count);
        for ($i = 1; $i <= $count; $i++) {
            $months[$count - $i + 1] = $currentMonth->format('F'); // Get the current month first
            $currentMonth->subMonth(); // Then subtract one month for the next iteration
        }
        // return $months;
        return array_reverse($months, true);
    }

    public function getQuotesCount()
    {
        // Get quotes count for each month
        $quotes = [];
        foreach ($this->inqBookings['months'] as $month) {
            $quotes[] = Booking::agentFilter()->whereNull('booking_id')->whereMonth('created_at', Carbon::parse($month)->month)->count();
        }
        return $quotes;
    }

    public function getBookings()
    {
        //count bookings
        $bookings = [];
        foreach ($this->inqBookings['months'] as $month) {
            $bookings[] = Booking::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->count();
        }
        return $bookings;
    }

    public function getBookingShare()
    {
        // Fetch counts of bookings grouped by service type and get the service type names
        $bookingData = Booking::join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
            ->select('aihut_service_type.name as service_type_name', DB::raw('COUNT(*) as count'))
            ->where('aihut_booking.agency_id', auth()->guard('agent')->user()->id)
            ->groupBy('aihut_service_type.name')
            ->orderBy('count', 'desc') // Optional: order by count if needed
            ->get();

        // Prepare data arrays for counts and labels
        $counts = $bookingData->pluck('count')->toArray();
        $labels = $bookingData->pluck('service_type_name')->toArray();

        return [
            'data' => $counts,
            'labels' => $labels
        ];
    }

    public function getPackagesByServiceType()
    {
        // Join the packages table with the service_type table and group by service_type name
        // $packages = DB::table('aihut_packages')
        //     ->join('aihut_service_type', 'aihut_packages.service_id', '=', 'aihut_service_type.id')
        //     ->select('aihut_service_type.name as service_type_name', DB::raw('COUNT(aihut_packages.id) as count'))
        //     ->groupBy('aihut_service_type.name')
        //     ->get();
        $packages = Booking::join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
            ->where('aihut_booking.agency_id', auth()->guard('agent')->user()->id)
            ->select('aihut_service_type.name as service_type_name', DB::raw('COUNT(*) as count'))
            ->groupBy('aihut_service_type.name')
            ->orderBy('count', 'desc') // Optional: order by count if needed
            ->get();

        $result = [
            'service_type_names' => $packages->pluck('service_type_name')->toArray(),
            'counts' => $packages->pluck('count')->toArray(),
        ];

        return $result;
    }

    public function getServiceByMonth()
    {
        $bookings = [];
        foreach ($this->bookingByServiceType['months'] as $month) {
            $hajj[] = Booking::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 1)->count();
            $umrah[] = Booking::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 2)->count();
            $ramzan[] = Booking::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 20)->count();
            $ziarat[] = Booking::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 21)->count();
        }
        $bookings['hajj'] = $hajj;
        $bookings['umrah'] = $umrah;
        $bookings['ramzan'] = $ramzan;
        $bookings['ziarat'] = $ziarat;
        return $bookings;
    }

    public function getPaymentByMonth()
    {
        $payments = [];
        foreach ($this->paymentsByMonth['months'] as $month) {
            $data = Payment::agentFilter()->whereMonth('created_at', Carbon::parse($month)->month)->where(['payment_status' => 1, 'is_paid' => 1])->sum('amount');
            $payments[] = Helper::properDecimals($data);
        }
        return $payments;
    }

    #[Layout('agent.layouts.app')]
    public function render()
    {
        return view('agent.dashkboard-component');
    }
}
