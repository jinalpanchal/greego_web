<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverLocation extends Model {

    protected $table = 'driverlocation';
    protected $fillable = ['driver_id', 'lat', 'lng'];

}
