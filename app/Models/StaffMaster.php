<?php

namespace App\Models;
use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class StaffMaster extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CommonScopes, SearchScopes, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'aihut_staff_master';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'role_id',
        'department_id',
        'office_no',
        'detail',
        'country_id',
        'city_id',
        'postal_code',
        'address',
        'photo',
        'salary',
        'password',
        'is_active',
    ];
    public function staffrole(): BelongsTo
    {
        return $this->belongsTo(StaffRoles::class, 'role_id');
    }
    public function staffdepartment(): BelongsTo
    {
        return $this->belongsTo(StaffDepartment::class, 'department_id');
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}

