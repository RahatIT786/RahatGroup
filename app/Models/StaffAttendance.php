<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class StaffAttendance extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'staff_attendance';

    protected $fillable = [
        'staff_id',
        'attendance_date',
        'log_in_time',
        'log_out_time',
        'total_hours',
        'work_day',
        'is_active',
    ];

    // Scope for descending order
    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    // Scope for active records
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    // Accessor for calculating total hours worked
    // public function getTotalHoursAttribute()
    // {
    //     if ($this->log_in_time && $this->log_out_time) {
    //         $logIn = Carbon::parse($this->log_in_time);
    //         $logOut = Carbon::parse($this->log_out_time);
    //         return $logOut->diffInHours($logIn) + ($logOut->diffInMinutes($logIn) % 60) / 60.0; // Total hours with decimals
    //     }
    //     return 0; // Return 0 if no log_in_time or log_out_time is available
    // }

    // Accessor for attendance status
    // In your StaffAttendance model

// Accessor for attendance status
// In your StaffAttendance model
public function getWorkingDayAttribute()
{
    // Count the number of attendance records with log_in_time present for the specific staff
    return $this->where('staff_id', $this->staff_id)
                ->whereNotNull('log_in_time')
                ->count();
}


    // Define relationship with Staff model
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
