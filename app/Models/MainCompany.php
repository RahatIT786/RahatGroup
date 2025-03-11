<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCompany extends Model
{
    use HasFactory;

    protected $table = 'main_companies';

    protected $fillable = [
        'company_name',
        'company_dly_name',
        'company_contect_person',
        'company_mobile',
        'company_landline_number',
        'company_email',
        'company_website_name',
        'company_registered_address',
        'company_about',
        'company_pan',
        'company_gst',
        'company_state',
        'company_city',
        'company_logo',
        'delete_status', // Added delete_status
    ];
}
