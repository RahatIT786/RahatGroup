<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\HolidayDestination;

class HolidayTour extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_domestic_tours';

    protected $fillable = ['name','slug','state_id','destination','tour_types','itinerary','categories','nights','includes','is_active'];
    

    public function state(): BelongsTo
    {
        return $this->belongsTo(IndianStateAndUt::class, 'state_id');
    }

    public function tourImages()
    {
        return $this->hasMany(DomesticTourImage::class, 'tour_id', 'id');
    }

    public function tourDetails()
    {
        return $this->hasMany(HolidayTourDetails::class, 'domestic_tour_id', 'id');
    }
}
