<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_ticket_enquiries';
    protected $fillable = [
        'unique_id',
        'name',
        'email',
        'phone',
        'travel_date',
        'city_id',
        'support_team',
        'flight_id',
        'adults',
        'children',
        'infants',
        'message',
        'status',
        'is_active',
    ];
    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }
    public function flight(): BelongsTo
    {
        return $this->belongsTo(FlightMaster::class, 'flight_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
