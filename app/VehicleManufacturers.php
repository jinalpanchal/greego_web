<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleManufacturers extends Model
{
    protected $table = 'vehicle_manufacturers';
    protected $fillable = ['name'];

     public function vehicles() {
         return $this->HasMany('App\Vehicle','vehicle_manufacturer_id');
    }
    
}
