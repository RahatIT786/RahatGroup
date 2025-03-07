<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class TouristVisa extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_tourist_visa';
    protected $fillable = [
        'unique_id',
        'country_id',
        'visa_type',
        'cust_name',
        'cust_mob',
        'cust_email',
        'cust_nationality',
        'cust_pp_front',
        'cust_pp_back',
        'cust_emirate_id',
        'support_team',
        'status',

    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }
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
}
