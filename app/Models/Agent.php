<?php



namespace App\Models;



use App\Traits\CommonScopes;

use App\Traits\SearchScopes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;



class Agent extends Model

{

    use HasFactory, SoftDeletes, CommonScopes, SearchScopes;



    protected $table = 'aihut_agent';



    protected $fillable = [

        'agency_name',

        'owner_name',

        'country_id',

        'state_id',

        'city',

        'mobile',

        'email',

        'gst',

        'website',

        'company_logo',

        'pan',

        'password',

        'profile_img',

        'is_paid',

        'membership',

        'rm_country_id',

        'rm_city_id',

        'rm_staff_id',

        'rel_manager',

        'website_url',

        'website_name',

        'valid_upto',
        'last_login_time',
        'nearest_police_station',
        'office_drawing_layout_plan',
        'drawing_layout_plan_approved_by',
        'date_of_approval',
        'address',
        'personal_docs',
        'official_docs',
        'landline',
        'id_proofs',
        'office_address_proof',
        'cancelled_cheque',
        'owners_passport',
        'owners_adhaar',
        'owners_pancard',
        'company_name_proof',
        'gst_certificate',
        'office_board',
        'reception',
        'waiting_area',
        'boss_cabin',
        'company_logo',
        'is_active',
    ];



    public function state(): BelongsTo

    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    //Scope

    public function scopeActive($query)

    {

        return $query->where('is_active', 1);

    }



    public function scopeDesc($query)

    {

        return $query->OrderBy('id', 'DESC');

    }

    //Relationship
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'booking_id', 'booking_id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class, 'membership');
    }

    public function staffmaster(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'rm_staff_id');
    }

}

