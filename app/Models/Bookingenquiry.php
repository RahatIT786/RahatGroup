<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookingenquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_booking_enquiries';
    protected $fillable = [
        'unique_id',
        'city_id',
        'airline_id',
        'cat_id',
        'pkg_type_id',
        'cust_name',
        'cust_email',
        'cust_num',
        'travel_date',
        'food',
        'visa',
        'air_ticket',
        'cust_msg',
        'support_team',
        'comment',
        'pkg_flavour_id',
        'passengers',
        'adults',
        'children',
        'infants',
        'status'
    ];

    public function servicetype(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'cat_id');
    }

    public function packagemaster(): BelongsTo
    {
        return $this->belongsTo(Packages::class, 'pkg_type_id');
    }

    public function packagetype(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'pkg_flavour_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(FlightMaster::class, 'airline_id');
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeSearchCategory($query, $value)
    {
        return $query->when(!empty($value), function ($q) use ($value) {
            $q->where('cat_id', $value);
        });
    }
}
