<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agm extends Model
{
    use HasFactory, SearchScopes,SoftDeletes, CommonScopes;

    protected $table = 'agms';

    protected $fillable = ['name', 'description', 'photo', 'is_active'];

    public function agmimage()
    {
        return $this->hasOne(AgmImage::class);
    }

    public function agmimages()
    {
        return $this->hasMany(AgmImage::class);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}

