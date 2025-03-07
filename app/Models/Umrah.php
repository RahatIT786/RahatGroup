<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umrah extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_customized_umrah';
    protected $fillable = [
        'unique_id',
        'nights_makkah',
        'nights_medina',
        'hotel_type',
        'adults',
        'children',
        'infants',
        'sharing_type',
        'travel_date',
        'departure_city_id',
        'departure_country_id',
        'with_food',
        'with_visa',
        'with_ticket',
        'name',
        'mobile',
        'email',
        'nationality',
        'comments',
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'departure_country_id');
    }

    public function city(): BelongsTo

    {

        return $this->belongsTo(City::class, 'departure_city_id');
    }
}
