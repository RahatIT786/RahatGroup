<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedBack extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_feedbacks';
    protected $fillable = [
        'feedback_cat',
        'cust_name',
        'cust_email',
        'cust_num',
        'cust_msg',
        'is_active',
    ];




    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function getTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
