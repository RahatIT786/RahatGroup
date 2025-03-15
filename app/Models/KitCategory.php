<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KitCategory extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_kit_category';
    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'kit_item_id',
        'kit_category_img',
        'description',
        'price',
        'is_active',
    ];

    //Scope
    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    // Accessor for kit_item_id to convert to an array
    public function getKitItemIdAttribute($value)
    {
        return is_string($value) ? explode(',', $value) : [];
    }

    // public function setKitItemIdAttribute($value)
    // {
    //     $this->attributes['kit_item_id'] = is_array($value) ? implode(',', $value) : $value; // Ensure it's a string
    // }

    public function kitItems() // Use plural for multiple items
    {
        return $this->hasMany(KitItem::class, 'id', 'kit_item_id');
    }

    // public function getKitItemsNames()
    // {
    //     return KitItem::whereIn('id', $this->kit_item_id)
    //         ->pluck('kit_name')
    //         ->implode(', ');
    // }

    public function getKitItemsNames()
    {
        return KitItem::whereIn('id', $this->kit_item_id)
             ->pluck('kit_name')
             ->implode(', ');
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'category_id');
    }
}
