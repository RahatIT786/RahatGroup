<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PageContent extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;
    protected $table = 'aihut_user_page_list';

    protected $fillable = [
        'page_name',
        'is_active',
    ];
}