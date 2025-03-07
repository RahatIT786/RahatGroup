<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cars extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_cars';
    protected $fillable = [
        'car_sector_id',
        'car_type_id',
        'no_of_seats',
        'air_conditioner',
        'terms',
        'description',
        'price',
        'is_active',
    ];

    public function cartypemaster(): BelongsTo
    {
        return $this->belongsTo(CarTypeMaster::class, 'car_type_id');
    }

    public function carsectormaster(): BelongsTo
    {
        return $this->belongsTo(CarSectorMaster::class, 'car_sector_id');
    }

    public function carimage()
    {
        return $this->hasOne(CarImage::class, 'car_id');
    }

    public function carimages()
    {
        return $this->hasMany(CarImage::class, 'car_id');
    }

    public function scopeSearchCarTypeMaster($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('cartypemaster', function ($query) use ($value) {
                $query->where('car_type', "LIKE", "%{$value}%");
            });
        });
    }
}
