<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    
    protected $fillable = ['model','vehicle_manufacturer_id'];
    
    function vmake() {
        return $this->belongsTo('App\VehicleManufacturers','vehicle_manufacturer_id');
    }

    
}
