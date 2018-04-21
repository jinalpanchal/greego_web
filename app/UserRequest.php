<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserRequest extends Model {

    protected $table = 'requests';
    protected $fillable = ['user_id', 'user_vehicle_id', 'from_address','from_lat','from_lng','to_address','to_lat','to_lng','total_estimated_travel_time','total_estimated_trip_cost'];
}
