<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_booking';

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'phone',
    //     'message',
    //     'is_active',
    //     'completed',
    // ];

    //Relationship
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    public function servicetype(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_type');
    }
    public function pnr(): BelongsTo
    {
        return $this->belongsTo(Pnr::class, 'pnr_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    //Scope
    public function scopeSearchAgent($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('agency', function ($query) use ($value) {
                $query->where('agency_name', "LIKE", "%{$value}%");
            });
        });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
    public function scopePending($query)
    {
        return $query->where('booking_status', '0');
    }
    public function scopeApproved($query)
    {
        return $query->where('booking_status', '1');
    }
    public function scopeRejected($query)
    {
        return $query->where('booking_status', '2');
    }
    public function scopeCancelled($query)
    {
        return $query->where('booking_status', '3');
    }
    public function scopeSuspended($query)
    {
        return $query->where('booking_status', '4');
    }
    public function scopeUnderReview($query)
    {
        return $query->where('booking_status', '5');
    }
    public function scopeDeleted($query)
    {
        return $query->where('booking_status', '6');
    }
    public function scopeWaitingList($query)
    {
        return $query->where('booking_status', '7');
    }
}
