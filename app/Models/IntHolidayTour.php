<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class IntHolidayTour extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_international_tours';

    protected $fillable = ['name','slug','country_id','destination','tour_types','itinerary','categories','nights','includes','is_active'];
    

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function tourImages()
    {
        return $this->hasMany(IntTourImage::class, 'tour_id', 'id');
    }

    public function tourDetails()
    {
        return $this->hasMany(IntHolidayTourDetails::class, 'int_tour_id', 'id');
    }
}
