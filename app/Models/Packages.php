<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Packages extends Model
{   
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;
    
    protected $table = 'aihut_packages';
    protected $fillable = ['name','type_ids','service_id','umrah_type','image','description','payment_policy','important_notes','cancellation_policy','inclusion','exclusion','itinerary','flight_transport','meals','visa_taxes','is_active'];


    public function scopeDesc($query)
    {
        return $query->OrderBy('id', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function pkgDetails()
    {
        return $this->hasMany(PackageDetails::class, 'pkg_id', 'id')
                ->orderBy('g_share', 'asc');
    }

    public function pkgImages()
    {
        return $this->hasMany(PackageImage::class, 'pkg_id', 'id');
    }


    public function getPkgTypeNamesAttribute()
    {
        if (empty($this->type_ids)) {
            return [];
        }

        // Convert the comma-separated string into an array
        $pkgTypeIds = explode(',', $this->type_ids);
        
        // Retrieve the names from the PkgType model
        return PackageType::whereIn('id', $pkgTypeIds)->pluck('package_type','id')->toArray();
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class, 'service_id');
    }
    public function pnrs()
    {
        return $this->hasMany(Pnr::class, 'pack_id', 'id');
    }
    public function filteredPnrs()
    {
        return Pnr::whereRaw("FIND_IN_SET(?, pack_id)", [$this->id])->first();
    }


}
