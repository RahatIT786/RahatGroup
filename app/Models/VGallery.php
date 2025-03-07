<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VGallery extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CommonScopes, SearchScopes, SoftDeletes;

    protected $table = 'aihut_v_gallery';
    protected $fillable = [
        'service_id',
        'package_id',
        'type',
        'is_active',
    ];

    //Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeSearchPackage($q, $value)
    {
        return $q->when(!empty($value), function ($qr) use ($value) {
            $qr->whereHas('packagetype', function ($query) use ($value) {
                $query->where('package_type', "LIKE", "%{$value}%");
            });
        });
    }

    public function packagetype(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'package_id');
    }

    public function galleryvideo(): HasMany
    {
        return $this->hasMany(GalleryVideo::class, 'v_gallery_id');
    }
}
