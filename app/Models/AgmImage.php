<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchScopes;
use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgmImage extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'agm_images';

    protected $fillable = [
        'agm_id',
        'image',
    ];
   
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
