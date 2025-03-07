<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodMaster extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_food_master';
    protected $fillable = [
        'food_type',
        'price',
        'description',
        'lunch',
        'dinner',
        'food_pdf',
        'is_active',
    ];

	public function foodimage()
    {
        return $this->hasOne(FoodImage::class, 'food_id');
    }

	public function foodimage_breakfast()
{
    return $this->hasMany(FoodImage::class, 'food_id')->where('food_type', 1);
}


public function foodimage_lunch()
{
    return $this->hasMany(FoodImage::class, 'food_id')->where('food_type', 2);
}
public function foodimage_dinner()
{
    return $this->hasMany(FoodImage::class, 'food_id')->where('food_type', 3);
}



    public function foodimages()
    {
        return $this->hasMany(FoodImage::class, 'food_id');
    }


    public function packagetype(): BelongsTo
    {
       return $this->belongsTo(PackageType::class, 'food_type');
    }

    //Scope
    // public function scopeDesc($query)
    // {
    //     return $query->OrderBy('id', 'DESC');
    // }
}
