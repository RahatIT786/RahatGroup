<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetterPost extends Model
{
    use HasFactory,SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_newsletter_post';

    protected $fillable = [
        'image',
    ];
}
