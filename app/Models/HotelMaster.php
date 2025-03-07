<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelMaster extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_hotel';

    protected $fillable = [
        'hotel_name',
        'star_rating',
        'city_id',
        'country_id',
        'distance',
        'google_map',
        'address',
        'hotel_overview',
        'contact',
        'email',
        'website_url',
        'check_in',
        'check_out',
        'hotel_price',
        'high_start_date',
        'high_end_date',
        'high_season_price',
        'medium_start_date',
        'medium_end_date',
        'medium_season_price',
        'low_start_date',
        'low_end_date',
        'low_season_price',
        'video',
        'is_active',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function hotelimage(): HasMany
    {
        return $this->hasMany(HotelImage::class, 'hotel_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeSearchCity($query, $field, $value)
    {
        return $query->when(!empty($value), function ($query) use ($field, $value) {
            $cities = Helper::hotelCity();
            foreach ($cities as $id => $name) {
                if (stripos($name, $value) !== false) {
                    return $query->where('city_id', $id);
                }
            }

        });
    }
}
