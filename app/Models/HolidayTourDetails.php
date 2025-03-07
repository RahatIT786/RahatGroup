<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HolidayTourDetails extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_domestic_tours_details';

    protected $fillable = ['domestic_tour_id','destination_id','tour_type_id','hotel_id','nights','price'];
    

    // public function state(): BelongsTo
    // {
    //     return $this->belongsTo(IndianStateAndUt::class, 'state_id');
    // }

    // public function tourImages()
    // {
    //     return $this->hasMany(DomesticTourImage::class, 'tour_id', 'id');
    // }

    public function tourType(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'tour_type_id');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(TourDestination::class, 'destination_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'hotel_id');
    }

    
}
