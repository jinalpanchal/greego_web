<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Response\ResponseHelper;
use Validator;
use App\DriverLocation;
use Twilio;

class DriverLocationController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function DriverLocation(Request $request)
    {
        try
        {
            // dd('Hello');
            $validator = Validator::make($request->all(), [
                'lat' => 'required|between:0,99.99',
                'lng' => 'required|between:0,99.99',
            ]);
            
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
        //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            
            $driver  = $request->user('driver');
            $DriverLoc = DriverLocation::where('driver_id', '=', $driver->id)->first();
            if ($DriverLoc == null){
                $DriverLocation = new DriverLocation;                  
                $DriverLocation->driver_id = $driver->id;
                $DriverLocation->lat = $request->post('lat');
                $DriverLocation->lng = $request->post('lng');
                $DriverLocation->save();
                //dd($request->id);
            } else {
                $DriverLocation = DriverLocation::where('driver_id', '=', $driver->id)->update(['lat' => $request->post('lat'), 'lng' => $request->post('lng')]);
            }
            $response = array(
                    "data" => $DriverLocation,
                    "error_code" => 0,
                    "message" => ""
                );
        }
        catch (\Exception $e) {
            $response = array(
                    "data" => [],
                    "error_code" => 1,
                    "message" => "Driver Location Failed ".$e->getMessage()
                );            
        }
        return response()->json($response);
    }

    
}
