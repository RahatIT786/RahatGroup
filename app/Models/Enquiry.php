<?php

namespace App\Models;


use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Enquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_enquiries';
    protected $fillable = [
        'unique_id',
        'cat_id',
        'city_name',
        'name',
        'email',
        'mobile_num',
        'whatsapp_num',
        'support_team',
        'comment',
        'status',
    ];
    public function scopeOrderdesc($query)
    {
        return $query->orderby('id', 'desc');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeNotdelete($query)
    {
        return $query->where('is_delete', 0);
    }

    public function servicetype(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'cat_id');
    }

    // public function city(): BelongsTo
    // {
    //     return $this->belongsTo(City::class, 'city_name');
    // }

    public function scopeSearchServiceType($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('servicetype', function ($query) use ($value) {
                $query->where('name', "LIKE", "%{$value}%");
            });
        });
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }
}
