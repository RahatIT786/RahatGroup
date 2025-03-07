<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Forex extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_forex';
    protected $fillable = [
        'beneficiary_id',
        'company_id',
        'txn_date',
        'reference_no',
        'sar',
        'sar_rate',
        'amount',
        'gst',
        'handling_charges',
        'tot_amount',
        'types',
        'bank_name',
        'particularts',
        'is_active',
    ];

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function scopeSearchBeneficiaryName($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('beneficiary', function ($query) use ($value) {
                $query->where('beneficiary_name', "LIKE", "%{$value}%");
            });
        });
    }
}
