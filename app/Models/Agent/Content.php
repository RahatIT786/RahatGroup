<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Content extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;
    protected $table = 'aihut_content';

    protected $fillable = [
        'user_id',
        'page_id',
        'description',
        'is_active',
    ];
    public function pagecontent(): BelongsTo
    {
       return $this->belongsTo(PageContent::class, 'page_id');
    }
    public function scopeSearchPageContent($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('pagecontent', function ($query) use ($value) {
                $query->where('page_name', "LIKE", "%{$value}%");
            });
        });
    }


    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }
}