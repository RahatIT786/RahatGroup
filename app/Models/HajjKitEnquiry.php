<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HajjKitEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_hajjkit_enquiries';
    protected $fillable = [
        'unique_id',
        'kit_id',
        'name',
        'email',
        'delivery_date',
        'mobile_num',
        'address',
        'description',
        'support_team',
        'comment',
        'status'
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }
    public function kitcategory(): BelongsTo
    {
        return $this->belongsTo(KitCategory::class, 'kit_id');
    }

    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
