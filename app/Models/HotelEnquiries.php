<?php

namespace App\Models;


use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class HotelEnquiries extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_hotel_enquiries';
    protected $fillable = [
        'unique_id',
        'hotel_id',
        'cust_name',
        'country_id',
        'mob_num',
        'message',
        'support_team',
        'comment',
        'status',
    ];
    public function scopeOrderdesc($query)
    {
        return $query->orderby('id', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotdelete($query)
    {
        return $query->where('is_delete', 0);
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'hotel_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

    public function scopeSearchHotel($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('hotel', function ($query) use ($value) {
                $query->where('hotel_name', "LIKE", "%{$value}%");
            });
        });
    }
}
