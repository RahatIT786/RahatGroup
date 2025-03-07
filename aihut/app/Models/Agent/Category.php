<?php

namespace App\Models\Agent;

use App\Traits\CommonScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CommonScopes;

    protected $table = 'aihut_category';

    public function pages()
    {
        return $this->hasMany(Page::class, 'cate_id', 'id');
    }
}
