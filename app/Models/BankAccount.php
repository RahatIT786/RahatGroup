<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'account_name',
        'account_no',
        'ifsc_swift',
        'bank_name',
        'branch_name',
        'iban_no',
        'gst',
        'pan_card',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
