<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;
    protected $table = 'aihut_contactus';
    protected $fillable = [
        'agent_id',
        'salutation',
        'name',
        'phone',
        'email',
        'message',
        'is_active',
    ];
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
}
