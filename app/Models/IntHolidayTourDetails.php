<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IntHolidayTourDetails extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_int_tours_details';

    protected $fillable = ['int_tour_id','destination_id','tour_type_id','hotel_id','nights','price'];
    
    public function tourType(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'tour_type_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(IntTourDestination::class, 'destination_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'hotel_id');
    }

    
}
