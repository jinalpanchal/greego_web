<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class current_trips extends Model {

    protected $table = 'current_trips';
    protected $fillable = ['request_id', 'user_id', 'driver_id','status','actual_trip_amount','tip_amount','total_trip_amount','actual_trip_travel_time','payment_status','trip_driver_rating','trip_user_rating'];
}
