<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComplaintBox extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_complaint_box';
    protected $fillable = [
        'unique_id',
        'agency_name',
        'booking_id',
        'hotel_id',
        'airport',
        'room_no',
        'mobile',
        'departure_date',
        'guest_name',
        'description',
        'support_team',
        'status',
        'is_active',
    ];

    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function hotels(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'hotel_id');
    }


    public function agents(): BelongsTo
    {
        return $this->belongsTo(Agent::class, 'agency_name');
    }

    // public function country()
    // {
    //     return $this->belongsTo(Country::class, 'departure_country_id');
    // }

    // public function city(): BelongsTo

    // {

    //     return $this->belongsTo(City::class, 'departure_city_id');
    // }
}
