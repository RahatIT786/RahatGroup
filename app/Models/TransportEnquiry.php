<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransportEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_transport_enquiries';
    protected $fillable = [
        'unique_id',
        'pickup_from',
        'sector_id',
        'name',
        'email',
        'pickup_date',
        'pickup_time',
        'nationality',
        'mobile_home',
        'mobile_saudi',
        'whatsapp_num',
        'address',
        'description',
        'support_team',
        'comment',
        'status'
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

    public function carsectormaster()
    {
        return $this->belongsTo(CarSectorMaster::class, 'sector_id');
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
