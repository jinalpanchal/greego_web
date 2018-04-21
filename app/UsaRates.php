<?php

namespace App;    
use Illuminate\Database\Eloquent\Model;

class UsaRates extends Model
{
    protected  $table = "usa_rates";
    protected $fillable = ['usa_state_id','base_rate', 'trip_time', 'rate_per_mile', 'cancellation_rate', 'overmile_rate','is_active','created_at','updated_at'];
    public function state() {
         return $this->belongsTo('App\UsaState','usa_state_id');
    }
}
