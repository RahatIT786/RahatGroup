<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pnr extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_pnr_table';
    protected $fillable = [
        'pnr_code',
        'pack_id',
        'group_name',
        'flight_id',
        'dept_city_id',
        'flight_type',
        'departure_sector',
        'return_sector',
        'pnr_pack_type',
        'days',
        'seats',
        'avai_seats',
        'tour_leader',
        'supp_name',
        'transco_name',
        'mobno_tc',
        'adult_cost',
        'child_cost',
        'infant_cost',
        'itenary',
        'baggage',
        'cancel_fee',
        'transport_brn',
        'return_date',
        'dept_date',
        'dept_time',
        'return_time',
        'group_no',
        'contact_no',
        'sub_agent_name',
        'rawda_permit',
        'is_active',
    ];

    public function getPackagesAttribute()
    {
        $packageIds = explode(',', $this->pack_id);

        return PackageMaster::whereIn('id', $packageIds)->get();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
    public function scopeAscdate($query)
    {
        return $query->OrderBy('create_at', 'ASC');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Packages::class, 'pack_id');
    }
    public function packages(): BelongsTo
    {
        return $this->belongsTo(Packages::class, 'avai_seats');
    }
    public function flightdetails(): BelongsTo
    {
        return $this->belongsTo(FlightDetail::class, 'flight_id');
    }

    public function flight(): BelongsTo
    {
        return $this->belongsTo(FlightMaster::class, 'flight_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'dept_city_id');
    }

    public function departuresector(): BelongsTo
    {
        return $this->belongsTo(SectorMaster::class, 'departure_sector');
    }

    public function returnsector(): BelongsTo
    {
        return $this->belongsTo(SectorMaster::class, 'return_sector');
    }

    public function sector(): BelongsTo
    {
        return $this->belongsTo(SectorMaster::class, 'flight_id');
    }

    public function scopeSearchFlight($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('flight', function ($query) use ($value) {
                $query->where('flight_name', "LIKE", "%{$value}%");
            });
        });
    }

    public function scopeSearchCity($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('city', function ($query) use ($value) {
                $query->where('city_name', "LIKE", "%{$value}%");
            });
        });
    }

    public function scopeSearchPnrDate($q, $from)
    {
       
        return $q->when(!empty($from), function ($qr) use ($from) {

            $qr->whereDate('dept_date', '=', $from)->orwhereDate('return_date', '=', $from);

        });

    }
}
