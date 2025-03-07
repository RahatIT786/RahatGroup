<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRegister extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CommonScopes, SearchScopes, SoftDeletes;

    protected $table = 'aihut_user_register';
    protected $fillable = [

        'agent_id',
        'name',
        'email',
        'phone',
        'password',
        'cpassword',
        'address',
        'city',
        'country',
        'zipcode',
        'profile_image',
        'whatsapp_no',
        'remark',
        'wallet_balance',
        'is_subagent',
        'is_active',
    ];

    //Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function scopeSearchAgent($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('agency', function ($query) use ($value) {
                $query->where('agency_name', "LIKE", "%{$value}%");
            });
        });
    }
}
