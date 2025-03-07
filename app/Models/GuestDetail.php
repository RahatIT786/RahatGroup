<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestDetail extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_guest_details';

    protected $fillable = [
        'booking_id',
        'guest_first_name',
        'guest_last_name',
        'gender',
        'nationality',
        'relation_with_mehram',
        'passport_number',
        'pan_card',
        'date_of_birth',
        'age',
        'date_of_expiry',
        'photo',
        'passport_scan_front',
        'passport_scan_back',
        'vaccination_certificate',
        'pan',
        'visa_number',
        'visa_voucher',
        'visa_file',
        'tkt_number',
        'tkt_desc',
        'tkt_file',
        'is_active'
    ];

    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'relation_with_mehram');
    }
}
