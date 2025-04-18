<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoppingEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_shopping_enquiries';
    protected $fillable = [
        'unique_id',
        'delivery_date',
        'name',
        'email',
        'mobile',
        'address',
        'description',
        'support_team',
        'comment',
        'status',
        'is_active',
    ];




    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }
}
