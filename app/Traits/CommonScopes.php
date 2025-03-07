<?php

namespace App\Traits;

trait CommonScopes
{
    public function scopeActive($q)
    {
        return $q->where('is_active', 1);
    }

    public function scopeInactive($q)
    {
        return $q->where('is_active', '!=', 1);
    }

    public function scopeAsc($q, $column = "id")
    {
        return $q->orderBy($column, "ASC");
    }

    public function scopeDesc($q, $column = "id")
    {
        return $q->orderBy($column, "DESC");
    }
}
