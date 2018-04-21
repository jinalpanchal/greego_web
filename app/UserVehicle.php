<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    protected $table = 'user_vehicles';
    protected $fillable = ['user_id','vehicle_id','year','color','transmission_type','type'];
    public function vehiclemodel() {
       return $this->belongsTo('App\Vehicle','vehicle_id');
    }
}
