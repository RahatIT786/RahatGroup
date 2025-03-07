<?php

namespace App\Http\Controllers\Admin\StaffManagement\Attendance;

use Livewire\Component;
use App\Models\StaffDepartment;
use App\Models\StaffRoles;
use App\Models\Staff;
use Carbon\Carbon;

class AttendanceListComponent extends Component
{

    public $staff_departments, $staff_roles, $staffs = '';
    public $staff_department_id, $staff_role_id, $attend_month, $staff_attendance = [];

    public function mount()
    {
        $this->staff_departments = StaffDepartment::get();
        $this->staff_roles = StaffRoles::get();
    }

    public function getStaffs()
    {
        // dd($this->staff_department_id, $this->staff_role_id);
        $this->staffs = Staff::where('dept_id', $this->staff_department_id)->where('role_id', $this->staff_role_id)->get();
        // dd($this->staffs);
    }

    public function get_attendance_list()
    {
        // Get the number of days in the selected month and year
        $numDays = Carbon::parse($this->attend_month)->daysInMonth;

        // Find out which dates are Sundays
        // Get the number of days in the selected month and year
        $numDays = Carbon::parse($this->attend_month)->daysInMonth;

        // Create an array with dates and day names
        $datesWithDayNames = [];
        $startDate = Carbon::parse($this->attend_month)->startOfMonth();
        $endDate = Carbon::parse($this->attend_month)->endOfMonth();
        while ($startDate->lte($endDate)) {
            $datesWithDayNames[] = [
                'date' => $startDate->copy()->format('Y-M-d'),
                'day_name' => $startDate->copy()->format('l'),
            ];
            $startDate->addDay();
        }

        $this->staff_attendance = [
            'numDays' => $numDays,
            'datesWithDayNames' => $datesWithDayNames,
        ];


        // dd($this->staff_attendance);
    }

    public function render()
    {
        return view('admin.staff-management.attendance.attendance-list-component');
    }
}
