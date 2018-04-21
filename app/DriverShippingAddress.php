<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverShippingAddress extends Model {

    protected $table = 'driver_shipping_address';
    protected $fillable = ['driver_id', 'street', 'apt','city','zipcode','state'];

}

