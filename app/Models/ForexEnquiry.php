<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForexEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_forex_enquiry';
    protected $fillable = [
        'unique_id',
        'title',
        'full_name',
        'mob_num',
        'email_id',
        'currency_id',
        'amount',
        'delivery',
        'address',
        'support_team',
        'comment',
        'status',
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
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
