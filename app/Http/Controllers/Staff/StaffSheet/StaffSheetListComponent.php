<?php

namespace App\Http\Controllers\Staff\StaffSheet;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Models\StaffAttendance;

class StaffSheetListComponent extends Component
{
    public $today;
    public $endOfMonth;
    public $year;
    public $month;
    public $attendances;
    public $dates;
    public $totalSundays;
    public $totalDaysInMonth;
    public $totalWorkingDays;
    public $work_day;
    public $totalOvertime;
    public $fullDays;
    public $totalNoDays;
    public $totalAbsentDays;
    public $totalFullDays;
    public function mount()
    {
        $this->today = Carbon::now();
        $this->endOfMonth = $this->getEndOfMonth();
        $this->year = $this->today->year;
        $this->month = $this->today->month;
        $this->attendances = $this->getAttendancesWithTotalHours(); // Updated method call
        $this->dates = $this->getDatesForMonth();
        $this->totalDaysInMonth = $this->getTotalDaysInMonth();
        $this->totalAbsentDays = $this->calculateTotalAbsentDays();
        $this->totalOvertime = $this->calculateTotalOvertime();
        $this->totalFullDays = $this->calculateTotalFullDays();
        $this->totalNoDays = $this->calculateTotalNoDays();
        $this->totalWorkingDays = $this->calculateTotalWorkingDays(); // Calculate total working days
    }


    public function changeInput()
    {
        $this->validate([
            'year' => 'required|integer|min:2000|max:2099',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $this->totalDaysInMonth = $this->getTotalDaysInMonth();
        $this->attendances = $this->getAttendances();
        $this->dates = $this->getDatesForMonth();
        $this->totalOvertime = $this->calculateTotalOvertime();


        // Debugging
        // dd($this->totalDaysInMonth, $this->attendances, $this->dates);
    }

//Total days in a month
public function getTotalDaysInMonth()
{
    return Carbon::create($this->year, $this->month)->daysInMonth;
}

//Calculate total working days
    // public function calculateTotalWorkingDays()
    // {
    //     $workingDays = 0;

    //     foreach ($this->dates as $date) {
    //         $attendance = $this->attendances ? $this->attendances->firstWhere('attendance_date', $date['date']->toDateString()) : null;

    //         if ($attendance) {
    //             if ($attendance->total_minutes > 9 * 60 || $attendance->total_minutes >= 8 * 60) {
    //                 $workingDays++;
    //             }
    //         }
    //     }

    //     return $workingDays;
    // }

    protected function getAttendances()
    {
        $query = StaffAttendance::query();

        if ($this->year && $this->month) {
            $startDate = Carbon::create($this->year, $this->month, 1);
            $endDate = $startDate->copy()->endOfMonth();
            $query->whereBetween('attendance_date', [$startDate->toDateString(), $endDate->toDateString()]);
        } else {
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->endOfMonth();
            $query->whereBetween('attendance_date', [$startDate->toDateString(), $endDate->toDateString()]);
        }

        return $query->get();
    }

    protected function getDatesForMonth()
    {
        $startDate = Carbon::create($this->year, $this->month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        // Retrieve attendance records for the given month and year
        $attendances = $this->attendances->whereBetween('attendance_date', [$startDate, $endDate])->pluck('attendance_date')->toArray();

        $dates = [];
        $totalSundays = 0;
        $today = Carbon::now()->startOfDay();

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $status = in_array($date->toDateString(), $attendances) ? 'Present' : ($date->lt($today) ? 'Absent' : '');

            $isSunday = $date->isSunday();
            if ($isSunday) {
                $totalSundays++; // Increment the total Sundays counter
            }

            $dates[] = [
                'date' => $date->copy(),
                'is_sunday' => $isSunday,
                'status' => $status,
            ];
        }

        $this->totalSundays = $totalSundays; // Store the total Sundays in a public property

        return $dates;
    }


    protected function getAttendancesWithTotalHours()
{
    $attendances = StaffAttendance::whereBetween('attendance_date', [
        Carbon::create($this->year, $this->month, 1),
        Carbon::create($this->year, $this->month, 1)->endOfMonth()
    ])->get();

    foreach ($attendances as $attendance) {
        if ($attendance->log_in_time && $attendance->log_out_time) {
            $logInTime = Carbon::parse($attendance->log_in_time);
            $logOutTime = Carbon::parse($attendance->log_out_time);

            // Calculate the difference in minutes
            $totalMinutes = $logInTime->diffInMinutes($logOutTime);

            // Convert minutes to hours and remaining minutes
            $hours = intdiv($totalMinutes, 60); // Calculate total hours
            $minutes = $totalMinutes % 60; // Calculate remaining minutes

            // Store the formatted total hours and minutes
            $attendance->total_hours = sprintf('%d Hour %d Minutes', $hours, $minutes);
            $attendance->total_minutes = $totalMinutes;

            // Determine the work day type
            if ($totalMinutes > 9 * 60) {
                $attendance->work_day = 'Overtime';
            } elseif ($totalMinutes >= 8 * 60) {
                $attendance->work_day = 'Full Day';
            } else {
                $attendance->work_day = 'No Day';
            }
        } else {
            $attendance->total_hours = ''; // Set to empty if either time is missing
            $attendance->total_minutes = '';
            $attendance->work_day = 'No Day';
        }
    }

    // dd($attendances->map(function ($attendance) {
    //     return [
    //         'total_hours' => $attendance->total_hours,
    //         'work_day' => $attendance->work_day
    //     ];
    // }));

    return $attendances;
}

    protected function getEndOfMonth()
    {
        return Carbon::now()->endOfMonth()->format('d-m-Y');
    }

//calculate totalabsentday
protected function calculateTotalAbsentDays()
{
    $totalAbsentDays = 0;

    foreach ($this->dates as $date) {
        if ($date['status'] === 'Absent' && !$date['is_sunday']) {
            $totalAbsentDays++;
        }
    }

    return $totalAbsentDays;
}


//calculate total Overtime
protected function calculateTotalOvertime()
{
    $totalOvertime = 0;

    foreach ($this->attendances as $attendance) {
        if ($attendance->work_day === 'Overtime') {
            $totalOvertime++;
        }
    }

    return $totalOvertime;
}

// Calculate total full days
protected function calculateTotalFullDays()
{
    $fullDays = 0;

    foreach ($this->attendances as $attendance) {
        if ($attendance->work_day === 'Full Day') {
            $fullDays++;
        }
    }

    return $fullDays;
}
//total no-day
protected function calculateTotalNoDays()
    {
        return $this->attendances->filter(fn($attendance) => $attendance->work_day === 'No Day')->count();
    }

    // Calculate total working days (excluding absent days and Sundays)
protected function calculateTotalWorkingDays()
{
    $totalWorkingDays = 0;

    foreach ($this->dates as $date) {
        // Exclude Sundays and Absent days
        if (!$date['is_sunday'] && $date['status'] === 'Present') {
            $totalWorkingDays++;
        }
    }

    return $totalWorkingDays;
}



    #[Layout('staff.layouts.app')]
    public function render()
    {
        return view('staff.staff-sheet.staff-sheet-list-component', [
            'attendances' => $this->attendances,
            'today' => $this->today->format('d-m-Y'),
            'endOfMonth' => $this->endOfMonth,
            'dates' => $this->dates,
            'totalAbsentDays' => $this->totalAbsentDays,
            'totalOvertime' => $this->totalOvertime,
            'totalFullDays' => $this->totalFullDays,
            'totalNoDays' => $this->totalNoDays,
            'totalWorkingDays' => $this->totalWorkingDays, // Pass total working days to the view
        ]);
    }

}
