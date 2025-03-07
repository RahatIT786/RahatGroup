<?php

namespace App\Models\Staff;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes,CommonScopes,SearchScopes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'is_active',
        'completed',
    ];
}
