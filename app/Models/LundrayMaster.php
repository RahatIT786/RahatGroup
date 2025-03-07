<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LundrayMaster extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_lundray';
    // protected $fillable = [
        // 'name',
        // 'price',
        // 'description',
        // 'is_active',
    // ];
    
    //Scope
    // public function scopeDesc($query)
    // {
    //     return $query->OrderBy('id', 'DESC');
    // }
}
