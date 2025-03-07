<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Award extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_awards';
    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'is_active',
    ];

    public function awardimage()
    {
        return $this->hasOne(AwardImage::class);
    }



    public function awardimages()
    {
        return $this->hasMany(AwardImage::class);
    }

   
    //Scope
    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
