<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, CommonScopes;

    protected $table = 'aihut_page';
}
