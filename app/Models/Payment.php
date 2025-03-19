<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $fillable = [
        'agent_id',
        'booking_id',
        'receipt_id',
        'deposite_type',
        'amount',
        'company',
        'bank_name',
        'txn_id',
        'txn_date',
        'bank_account_no',
        'personal_name',
        'comment',
        'payment_status',
        'is_paid',
    ];


    protected $table = 'aihut_payments';

    public function scopePending($query)
    {
        return $query->where('payment_status', '0');
    }
    public function scopeApproved($query)
    {
        return $query->where('payment_status', '1');
    }
    public function scopeUnclear($query)
    {
        return $query->where('payment_status', '2');
    }
    public function scopeBounce($query)
    {
        return $query->where('payment_status', '3');
    }
    public function scopeNotReceived($query)
    {
        return $query->where('payment_status', '4');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }


    public function scopeSearchAgent($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('booking.agency', function ($query) use ($value) {
                $query->where('agency_name', 'LIKE', "%{$value}%");
            });
        });
    }

    public function scopeSearchTransactionDate($q, $from, $to)
    {
        return $q->when(!empty($from) && !empty($to), function ($qr) use ($from, $to) {
            $qr->whereDate('txn_date', '>=', $from)->whereDate('txn_date', '<=', $to);
        });
    }

    public function scopeAgentFilter($q)
    {
        return $q->whereHas('booking.agency', fn($query) => $query->whereId(auth()->guard('agent')->user()->id));
    }

    //Relationship
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
        //  return $this->belongsTo(Booking::class, 'id', 'booking_id');
    }

    public function scopeSearchBookinId($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('booking', function ($query) use ($value) {
                $query->where('booking_id', "LIKE", "%{$value}%");
            });
        });
    }
}
