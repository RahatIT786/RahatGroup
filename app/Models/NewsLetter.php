<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsLetter extends Model
{
    use HasFactory,SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_newsletter';

    protected $fillable = [
        'name','email','city','mobile',
    ];
}
