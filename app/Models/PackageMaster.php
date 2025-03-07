<?php



namespace App\Models;



use App\Traits\CommonScopes;

use App\Traits\SearchScopes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;



class PackageMaster extends Model

{

    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;



    protected $table = 'aihut_package_master';

    protected $fillable = [

        'package_name',

        'package_type',

        'makka_rating',

        'makka_city_id',

        'makka_hotel',

        'madina_rating',

        'madina_city_id',

        'madina_hotel',

        'package_includes',

        'dept_city_id',

        'flight_id',

        'g_share_price',

        'qt_share_price',

        'qd_share_price',

        't_share_price',

        'd_share_price',

        'single_price',

        'child_w_b',

        'child_wo_b',

        'infants',

        'laundray_type',

        'transport_type',

        'food_type',

        'visa_type',

        'package_image',

        'service_id',

        'moullim_no',
        'stay_id',

        'description',

        'is_active',

    ];



    //Scope

    public function scopeDesc($query)

    {

        return $query->OrderBy('id', 'DESC');

    }



    public function scopeActive($query)

    {

        return $query->where('is_active', 1);

    }





    public function makkahotel(): BelongsTo

    {

        return $this->belongsTo(HotelMaster::class, 'makka_hotel');

    }

    public function madinahotel(): BelongsTo

    {

        return $this->belongsTo(HotelMaster::class, 'madina_hotel');

    }

    public function food_type_master(): BelongsTo

    {

        return $this->belongsTo(FoodMaster::class, 'food_type');

    }

    public function lundrytype(): BelongsTo

    {

        return $this->belongsTo(LaundryMaster::class, 'laundray_type');

    }

    public function foodType(): BelongsTo

    {

        return $this->belongsTo(FoodMaster::class, 'food_type');

    }

    public function packageType(): BelongsTo

    {

        return $this->belongsTo(PackageType::class, 'package_type');

    }



   

}

