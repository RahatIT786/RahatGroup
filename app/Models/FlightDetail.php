<?php

namespace App\Models;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlightDetail extends Model
{
    use HasFactory, SoftDeletes, CommonScopes;

    protected $table = 'aihut_flight_details';

    // protected $fillable = [
    //     'flight_name',
    //     'flight_logo',
    //     'is_active',
    // ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
