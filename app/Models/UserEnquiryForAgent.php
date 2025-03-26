<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEnquiryForAgent extends Model
{
    use HasFactory;
    protected $table = 'user_enquiry_for_agents';
    protected $fillable = ['name', 'email', 'mobile', 'message', 'agent_id', 'agent_name','delete_status'];
}
