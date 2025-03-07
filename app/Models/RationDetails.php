<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RationDetails extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_ration_details';
    protected $fillable = [
        'ration_id',
        'main_item',
        'description',
        'city_id',
        'weight',
        'rate',
        'total_rate',
        'is_active',
    ];

    public function ration(): BelongsTo
    {
        return $this->belongsTo(Ration::class, 'ration_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
