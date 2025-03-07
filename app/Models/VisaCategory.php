<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisaCategory extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_visa';
    protected $fillable = [
        'countryid',
        'visa_name',
        'description',
        'is_active',
    ];
    public function country(): BelongsTo
    {
       return $this->belongsTo(Country::class, 'countryid');
    }

    public function visadetail(): HasMany
    {
       return $this->hasMany(VisaDetails::class, 'visa_id');
    }

    public function scopeSearchCountry($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('country', function ($query) use ($value) {
                $query->where('countryname', "LIKE", "%{$value}%");
            });
        });
    }

}
