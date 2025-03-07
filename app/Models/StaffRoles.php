<?php

namespace App\Models;

use App\Traits\CommonScopes;
use App\Traits\SearchScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class StaffRoles extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, CommonScopes, SearchScopes, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'aihut_staff_role';

    protected $fillable = [
        'staff_role',
        'is_active',
    ];
}
