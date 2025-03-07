<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, CommonScopes, SearchScopes;

    protected $table = 'aihut_agent';

    protected $fillable = ['staff_id', 'date', 'clock_in', 'clock_out', 'status'];
}
