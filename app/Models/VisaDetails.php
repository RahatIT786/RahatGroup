<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisaDetails extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_visa_details';

    protected $fillable = [
        'country_id',
        'visa_id',
        'entry_type',
        'visa_validity',
        'stay_period',
        'visa_price',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function country(): BelongsTo
    {
       return $this->belongsTo(Country::class, 'country_id');
    }

    public function visatype(): BelongsTo
    {
       return $this->belongsTo(VisaCategory::class, 'visa_id');
    }

}

