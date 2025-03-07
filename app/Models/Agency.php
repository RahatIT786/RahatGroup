<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CommonScopes, SearchScopes, SoftDeletes;

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
        'is_active',
    ];
     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
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





}

