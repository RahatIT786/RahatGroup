<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteBankInfo extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'site_bank_infos';

    protected $fillable = ['bank_name', 'account_number', 'bank_address', 'ifsc_code', 'is_active'];

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
