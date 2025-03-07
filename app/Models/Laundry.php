<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laundry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_laundry';

    protected $fillable = [
        'unique_id',
        'booking_date',
        'no_of_guest',
        'name',
        'email',
        'mobile',
        'whatsapp',
        'hotel_name',
        'support_team',
        'comments',
        'status',
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

}
