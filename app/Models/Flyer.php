<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flyer extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_flyers';

    protected $fillable = ['agency_id', 'flyer_title', 'package_ids', 'header_image', 'header_text', 'footer_image', 'footer_text', 'important_notes', 'terms_cond'];

    protected $casts = [
        'package_ids' => 'json',
    ];

    public function agency(): BelongsTo
    {

        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
