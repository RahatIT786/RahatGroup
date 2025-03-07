<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribers extends Model
{
    public $timestamps = false;
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_partner_subscribers';

    protected $fillable = [
        'agent_id',
        'email',
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
}
