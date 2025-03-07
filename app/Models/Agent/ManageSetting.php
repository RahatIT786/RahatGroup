<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManageSetting extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;
    protected $table = 'aihut_agent_settings';

    protected $fillable = [
        'user_id',
        'parameter_id',
        'settings_value',
        'is_active',
    ];
    public function setting(): BelongsTo
    {
       return $this->belongsTo(Setting::class, 'parameter_id');
    }
    public function scopeSearchSetting($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('setting', function ($query) use ($value) {
                $query->where('parameter_name', "LIKE", "%{$value}%");
            });
        });
    }
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
}