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

class AssistantEnquiry extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_assistant_enquiries';

    protected $fillable = [
        'unique_id',
        'booking_date',
        'no_of_days',
        'name',
        'email',
        'mobile',
        'whatsapp',
        'hotel_name',
        'comments',
        'support_team',
        'status',
    ];

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'support_team');
    }

}
