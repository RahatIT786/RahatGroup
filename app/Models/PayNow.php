<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayNow extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_pay';
    protected $fillable = [
        'full_name',
        'email',
        'mob_num',
        'invoice_num',
        'currency_type',
        'amount',
        'company_name',
        'address',
        'city',
        'pincode',
        'country_id',
        'additional_notes'

    ];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // public function city(): BelongsTo

    // {

    //     return $this->belongsTo(City::class, 'callback_city_id');

    // }

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
