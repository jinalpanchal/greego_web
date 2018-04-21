<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\CurrentTrips;
use Twilio;

class CurrentTripsController extends Controller {

    public function CurrentTrips(Request $request)
    {
        try
        {
            $CurrentTrips = new CurrentTrips;                  
            $CurrentTrips->request_id = $request->post('request_id');
            $CurrentTrips->user_id = $request->post('user_id');
            $CurrentTrips->driver_id = $request->post('driver_id');
            $CurrentTrips->status = $request->post('status');
            $CurrentTrips->actual_trip_amount = $request->post('actual_trip_amount');
            $CurrentTrips->tip_amount = $request->post('tip_amount');
            $CurrentTrips->total_trip_amount = $request->post('total_trip_amount');
            $CurrentTrips->actual_trip_travel_time = $request->post('actual_trip_travel_time');
            $CurrentTrips->payment_status = $request->post('payment_status');
            $CurrentTrips->trip_driver_rating = $request->post('trip_driver_rating');
            $CurrentTrips->trip_user_rating = $request->post('trip_user_rating');
            $CurrentTrips->save();

            $response = array(
                    "data" => $CurrentTrips,
                    "error_code" => 0,
                    "message" => "CurrentTrips Active"
                );
        }
        catch (\Exception $e) {
            $response = array(
                    "data" => $CurrentTrips,
                    "error_code" => 1,
                    "message" => "CurrentTrip Failed"
                );            
        }
        return response()->json($response);
    }

}
