<?php

namespace App\Http\Controllers\Admin\Components;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopPackageComponent extends Component
{
    public $period = 'all', $periodText;

    public function getTopPackages($period)
    {
        $this->period = $period;
        $this->periodText = $this->getPeriodText($this->period);

        // Initialize query
        $query = Booking::join('aihut_packages', 'aihut_booking.package_name', '=', 'aihut_packages.id')
            ->select('aihut_packages.name as package_name', DB::raw('COUNT(*) as count'))
            ->groupBy('aihut_packages.name')
            ->orderBy('count', 'desc');

        // Apply date filter based on the selected period
        switch ($period) {
            case 'today':
                $query->whereDate('aihut_booking.created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('aihut_booking.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('aihut_booking.created_at', Carbon::now()->month)
                    ->whereYear('aihut_booking.created_at', Carbon::now()->year);
                break;
            case 'year':
                $query->whereYear('aihut_booking.created_at', Carbon::now()->year);
                break;
            case 'all':
                // No filter needed for all time
                break;
            default:
                throw new \InvalidArgumentException('Invalid period selected.');
        }

        // Fetch top 3 packages by booking count
        $topPackages = $query->limit(5)->get();

        // Calculate the percentage based on the highest count
        $maxCount = $topPackages->first()->count ?? 1; // Avoid division by zero

        $topPackages = $topPackages->map(function ($package) use ($maxCount) {
            $package->percentage = ($package->count / $maxCount) * 100;
            return $package;
        });

        return $topPackages;
    }

    public function getPeriodText($period)
    {
        if ($period == 'all') return "";
        elseif ($period == 'today') return "for $period";
        elseif ($period == 'week') return "for this $period";
        elseif ($period == 'month') return "for this $period";
        else return "for this $period";
    }

    public function render()
    {
        return view('admin.components.top-package-component', [
            'topPackages' => $this->getTopPackages($this->period),
        ]);
    }
}
