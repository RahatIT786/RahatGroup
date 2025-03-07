<?php

namespace App\Http\Controllers\Admin\Setting\Staff;

use App\Models\Staff;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class StaffSalaryListComponent extends Component
{
    use WithPagination, WithoutUrlPagination, LivewireAlert;
    public $perPage = 10, $currentSegment, $search_booking_id, $search_name, $search_travel_date, $today,$endOfMonth,$year,$month;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->year = $this->today->year;
        $this->month = $this->today->month;
        $staffSalaries = Staff::with('attendances')->get();

    }
//     public function getStaffSalary()
// {
//     return Staff::with(['attendances' => function ($query) {
//         $query->where('attendance_date', Carbon::today());
//     }])
//     ->when($this->month, function ($query) {
//         return $query->whereHas('attendances', function ($query) {
//             $query->whereMonth('attendance_date', $this->month)
//                   ->whereYear('attendance_date', $this->year);
//         });
//     })
//     ->orderBy('id', 'desc')
//     ->paginate($this->perPage);
// }


// public function getStaffSalary()
// {
//     // Get the number of days in the current month
//     $daysInMonth = Carbon::now()->daysInMonth;

//     $data =  Staff::with(['attendances' => function ($query) {
//         $query->whereMonth('attendance_date', $this->month)
//               ->whereYear('attendance_date', $this->year);
//     }])
//     ->when($this->month, function ($query) {
//         return $query->whereHas('attendances', function ($query) {
//             $query->whereMonth('attendance_date', $this->month)
//                   ->whereYear('attendance_date', $this->year);
//         });
//     })
//     ->orderBy('id', 'desc')
//     ->paginate($this->perPage)
//     ->map(function($staff) use ($daysInMonth) {
//         // Calculate daily salary
//         $dailySalary = $staff->salary / $daysInMonth;

//         // Get the number of working days from the attendance records
//         $workingDays = $staff->attendances->count();

//         // Calculate the total calculated salary
//         $staff->calculated_salary = $dailySalary * $workingDays;

//         return $staff; // Return the modified staff object
//     });

//     // dd($data);
//     return $data;
// }

public function getStaffSalary()
{
    // Get the number of days in the current month
    $daysInMonth = Carbon::now()->daysInMonth;

    // Fetch paginated staff salaries
    $StaffSalary = Staff::with(['attendances' => function ($query) {
                $query->whereMonth('attendance_date', $this->month)
                      ->whereYear('attendance_date', $this->year);
            }])
            ->when($this->month, function ($query) {
                return $query->whereHas('attendances', function ($query) {
                    $query->whereMonth('attendance_date', $this->month)
                          ->whereYear('attendance_date', $this->year);
                });
            })
    ->orderBy('id', 'desc')
    ->paginate($this->perPage); // This will keep the pagination

    // Calculate salaries after pagination
    foreach ($StaffSalary as $staff) {
        // Calculate daily salary
        $dailySalary = $staff->salary / $daysInMonth;

        // Get the number of working days from the attendance records
        $workingDays = $staff->attendances->count();

        // Calculate the total calculated salary
        $staff->calculated_salary = $dailySalary * $workingDays;
    }

    // dd($StaffSalary);
    return $StaffSalary;
}


public function filterStaffSalary()
{
    $this->resetPage(); // Reset pagination when filtering
}


    public function changeInput()
    {
        $this->validate([
            'year' => 'required|integer|min:2000|max:2099',
            'month' => 'required|integer|min:1|max:12',
        ]);
    }
    public function render()
    {

        return view('admin.setting.staff.staff-salary-list-component', [
            'StaffSalary' => $this->getStaffSalary(),
        ]);
    }
}
