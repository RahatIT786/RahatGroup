<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageDetails extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;

    protected $table = 'aihut_package_details';

    protected $fillable = ['pkg_id','pkg_type_id','makka_category','makka_hotel_id','madina_category','madina_hotel_id','meal_type','laundry_type','g_share','qt_share','qd_share','t_share','d_share','single','child_with_bed','chlid_no_bed','infant','package_includes'	];


    public function package()
    {
        return $this->belongsTo(Packages::class, 'pkg_id');
    }

    public function packageType(): BelongsTo
    {
        return $this->belongsTo(PackageType::class, 'pkg_type_id');
    }

    public function makkahotel(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'makka_hotel_id');
    }

    public function madinahotel(): BelongsTo
    {
        return $this->belongsTo(HotelMaster::class, 'madina_hotel_id');
    }

    public function mealType(): BelongsTo
    {
        return $this->belongsTo(FoodMaster::class, 'meal_type');
    }
    public function laundrytype(): BelongsTo
    {
        return $this->belongsTo(LaundryMaster::class, 'laundry_type');
    }
}
