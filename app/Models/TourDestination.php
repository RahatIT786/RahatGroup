<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourDestination extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_domestic_destination';

    protected $fillable = [
        'type',
        'state_ut_id',
        'name',
        'image',
        'is_active',
    ];

    //Relationship
    public function tourstate(): BelongsTo
    {
        return $this->belongsTo(TourState::class, 'id');
    }
    public function tours()
    {
        return $this->belongsToMany(HolidayTour::class);
    }

    //Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
}
