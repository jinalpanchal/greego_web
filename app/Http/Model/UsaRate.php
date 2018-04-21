<?php

namespace App\Model;    
use Illuminate\Database\Eloquent\Model;

class UsaRates extends Model
{
    protected  $table = "usa_rates";
    protected $fillable = ['base_rate', 'trip_time', 'rate_per_mile', 'cancellation_rate', 'overmile_rate', 'profile_pic', 'promocode', 'dob', 'legal_firstname', 'legal_middlename', 'legal_lastname','created_at','updated_atupdated_at'];
}
