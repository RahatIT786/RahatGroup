<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Agent\EventImageMaster;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventMaster extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_event';

    protected $fillable = [
        'agent_id',
        'title',
        'event_date',
        'is_active',
    ];

    public function eventimage(): HasMany

    {

        return $this->hasMany(EventImageMaster::class, 'event_id');
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
