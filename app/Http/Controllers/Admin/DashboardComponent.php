<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agency;
use App\Models\Agent;
use App\Models\Booking;
use App\Models\Bookingenquiry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class DashboardComponent extends Component
{
    public $inqBookings = [], $bookingShare, $topPackages, $packagesByServiceType, $bookingByServiceType = [];
    public $agents_counts,$active_agents_counts,$inactive_agents_counts;
    public function mount()
    {
        //Inquiries vs Bookings
        $this->inqBookings['months'] = $this->getPreviousMonths();
        $this->inqBookings['inquiries'] = $this->getInquiriesCount();
        $this->inqBookings['bookings'] = $this->getBookings();
        $this->bookingShare = $this->getBookingShare();
        $this->packagesByServiceType = $this->getPackagesByServiceType();
        $this->bookingByServiceType['months'] = $this->getPreviousMonths(5);
        $this->bookingByServiceType['data'] = $this->getServiceByMonth();
        // dd($this->getServiceByMonth());
        // dd($this->getBookingShare());
        // $agents = Agent::where('rm_staff_id', auth()->user()->id)->pluck('id');
        // $this->agents_counts = Agent::where('rm_staff_id', auth()->user()->id)->count();
        // $this->active_agents_counts =Agent::Active()->where('rm_staff_id', auth()->user()->id)->count();
        // $this->inactive_agents_counts = Agent::where('is_active',0)->where('rm_staff_id', auth()->user()->id)->count();

        $this->agents_counts = Agent::count(); // This counts all agents in the aihut_agent table
        $this->active_agents_counts = Agent::where('is_active', 1)->count();
$this->inactive_agents_counts = Agent::where('is_active', 0)->count();






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

    public function getInquiriesCount()
    {
        // Get inquiries count for each month
        $inquiries = [];
        foreach ($this->inqBookings['months'] as $month) {
            $inquiries[] = Bookingenquiry::whereMonth('created_at', Carbon::parse($month)->month)->count();
        }
        return $inquiries;
    }

    public function getBookings()
    {
        //count bookings
        $bookings = [];
        foreach ($this->inqBookings['months'] as $month) {
            $bookings[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->count();
        }
        return $bookings;
    }

    public function getBookingShare()
    {
        // Fetch counts of bookings grouped by service type and get the service type names
        $bookingData = Booking::join('aihut_service_type', 'aihut_booking.service_type', '=', 'aihut_service_type.id')
            ->select('aihut_service_type.name as service_type_name', DB::raw('COUNT(*) as count'))
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

    public function getServiceByMonth()
    {
        $bookings = [];
        foreach ($this->bookingByServiceType['months'] as $month) {
            $hajj[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 1)->count();
            $umrah[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 2)->count();
            $ramzan[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 20)->count();
            $ziarat[] = Booking::whereMonth('created_at', Carbon::parse($month)->month)->where('service_type', 21)->count();
        }
        $bookings['hajj'] = $hajj;
        $bookings['umrah'] = $umrah;
        $bookings['ramzan'] = $ramzan;
        $bookings['ziarat'] = $ziarat;
        return $bookings;
    }

    public function render()
    {
        $totalAgents = Agent::count();
        // dd($totalAgents);
        $activeAgents = Agent::where('is_active', 1)->count();
        $inactiveAgents = Agent::where('is_active', 0)->count();
        return view('admin.dashboard-component');
    }
}
