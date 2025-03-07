<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallUsBack extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_call_us_back';
    protected $fillable = [
        'unique_id',
        'title',
        'full_name',
        'mob_num',
        'email_id',
        'callback_country_id',
        'callback_city_id',
        'callback_time',
        'callback_date',
        'address',
        'support_team',
        'comment',
        'status',
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'callback_country_id');
    }

    public function city(): BelongsTo

    {

        return $this->belongsTo(City::class, 'callback_city_id');
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
}
