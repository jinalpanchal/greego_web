<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Response\ResponseHelper;
use Validator;
use App\UserRequest;
use App\Driver;
use App\User;
use App\current_trips;
use App\UserVehicle;
use App\Vehicle;
use App\VehicleManufacturers;
use Twilio;
use App\Helpers\Notification\PushNotification;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

   public function Request(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'user_vehicle_id' => 'required',
                        'from_address' => 'required',
                        'from_lat' => 'required',
                        'from_lng' => 'required',
                        'to_address' => 'required',
                        'to_lat' => 'required',
                        'to_lng' => 'required',
                        'total_estimated_travel_time' => 'required',
                        'total_estimated_trip_cost' => 'required',
            ]);

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $lat = (float) $request->from_lat;
            $lng = (float) $request->from_lng;
            $distance = 10;
            $results = DB::table('driverlocation')
                    ->selectRaw(' id, driver_id, lat, lng, (
                            3959 * acos (
                            cos ( radians(' . $lat . ') )
                            * cos( radians( lat ) )
                            * cos( radians( lng ) - radians(' . $lng . ') )
                            + sin ( radians(' . $lat . ') )
                            * sin( radians( lat ) )
                          )
                      ) AS distance')
                    ->havingRaw('distance < ' . $distance)
                    ->orderByRaw('distance DESC')
                    ->get();

            $user = auth()->user();
            $UserRequest = new UserRequest;
            $UserRequest->user_id = $user->id;
            $UserRequest->user_vehicle_id = $request->post('user_vehicle_id');
            $UserRequest->from_address = $request->post('from_address');
            $UserRequest->from_lat = $request->post('from_lat');
            $UserRequest->from_lng = $request->post('from_lng');
            $UserRequest->to_address = $request->post('to_address');
            $UserRequest->to_lat = $request->post('to_lat');
            $UserRequest->to_lng = $request->post('to_lng');
            $UserRequest->total_estimated_travel_time = $request->post('total_estimated_travel_time');
            $UserRequest->total_estimated_trip_cost = 100;
            $UserRequest->request_status = 0;
            $UserRequest->save();
            
            $driver_detail = $results->toArray();
            // dd($driver_detail);
               $msg = array(
                   'body' => $UserRequest->id,
                   'title' => 'User Request',
                   'icon' => 'myicon',
                   'sound' => 'mySound'
               );

           // $device_ids = 'd5VO2oR8wio:APA91bFuH6QYOCJs63BpXrFBkkJBEb04hL63RchcDLonD1BshBVp6p1kPW6cf8Y3OEzy_5i5KnMMjsMfE2B7GjtV6VmHwfD_q3GHm6MgC_XwHv7AeiBxYH1OgpQ94XTfXLaLJLF5-T_V';

           // PushNotification::PushAndroidNotificationUser($msg, $device_ids);

           foreach ($driver_detail as $d) {
            $driver_device_id = Driver::select('device_id')
                ->where('id', $d->driver_id)
                ->get()->toArray();     


                $device_ids = $driver_device_id[0]['device_id'];

                PushNotification::PushAndroidNotificationUser($msg, $device_ids);
           }
        
            $response = array(
                "data" => $UserRequest,
                "error_code" => 0,
                "message" => "Request Sent"
            );
        } catch (\Exception $e) {
            $response = array(
                "data" => $UserRequest,
                "error_code" => 1,
                "message" => "Request Failed"
            );
        }
        return response()->json($response);
    }


     public function viewrequest(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'request_id' => 'required',
            ]);

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $request_id = $request->post('request_id');
            $UserRequest = UserRequest::select('user_id','user_vehicle_id','from_lat', 'from_lng','to_lat','to_lng')
                ->where('id', $request_id)
                ->get()->toArray();

            $User = User::select('name','profile_pic')
                ->where('id', $UserRequest[0]['user_id'])
                ->get()->toArray();

            // For Notification 

            $user_vehicle_id = $UserRequest[0]['user_vehicle_id'];

            $uservehicles = UserVehicle::select('vehicle_id','year', 'color')
                ->where('id', $user_vehicle_id)
                ->get()->toArray();
            // dd($uservehicles);
            $vehicles = Vehicle::select('vehicle_manufacturer_id', 'model')
                ->where('id', $uservehicles[0]['vehicle_id'])
                ->get()->toArray();

            $VehicleManufacturers = VehicleManufacturers::select('name')
            ->where('id', $vehicles[0]['vehicle_manufacturer_id'])
            ->get()->toArray();

            $username = $User[0]['name'];
            $userimage = $User[0]['profile_pic'];
            $from_lat = $UserRequest[0]['from_lat'];
            $from_lng = $UserRequest[0]['from_lng'];
            $to_lat = $UserRequest[0]['to_lat'];
            $to_lng = $UserRequest[0]['to_lng'];
            $uservehicleyear = $uservehicles[0]['year'];
            $uservehiclecolor = $uservehicles[0]['color'];
            $uservehiclemodel = $vehicles[0]['model'];
            $uservehiclename = $VehicleManufacturers[0]['name'];

            $body = array(
                'username' => $username,
                'userimage' => $userimage,
                'from_lat' => $from_lat,
                'from_lng' => $from_lng,
                'to_lat' => $to_lat,
                'to_lng' => $to_lng,
                'vehicle_name' => $uservehiclename,
                'vehicle_model' => $uservehiclemodel,
                'vehicle_color' => $uservehiclecolor,
                'vehicle_year' => $uservehicleyear
            );

            $response = array(
                "data" => $body,
                "error_code" => 0,
                "message" => "Open SuccessFully"
            );
        } catch (\Exception $e) {
            $response = array(
                "data" => $UserRequest,
                "error_code" => 1,
                "message" => "Open Failed"
            );
        }
        return response()->json($response);
    }


    public function taptodrive(Request $request) {

        try {
            
            $UserRequestDetail = UserRequest::select('user_id','request_status')->where('id', '=', $request->post('request_id'))->get()->toArray();

            if($UserRequestDetail[0]['request_status']==0)
            {
                
                $UserRequest = UserRequest::select('user_id')->where('id', '=', $request->post('request_id'))->update(['request_status' => 1]);

                $user_id = $UserRequestDetail[0]['user_id'];
                $Driver  = $request->user('driver');
                $driver_detail = Driver::where('id', '=', $Driver->id)->first()->toArray();
                $user = User::select('device_id')->where('id', '=', $user_id)->first()->toArray();
                
                // dd($driver_detail);
                
                $body = array('name' => $driver_detail['name'],'contact_number' => $driver_detail['contact_number']);
                
                $msg = array(
                   'body' => $body,
                   'title' => 'Driver Request Accept',
                   'icon' => 'myicon',
                   'sound' => 'mySound'
                );

                $device_ids = $user['device_id'];

                PushNotification::PushAndroidNotification($msg, $device_ids);

                $current_trips = new current_trips;
                $current_trips->request_id = $request->post('request_id');
                $current_trips->user_id = $user_id;
                $current_trips->driver_id = $Driver->id;
                $current_trips->status = 1;
                $current_trips->actual_trip_amount = 0;
                $current_trips->tip_amount = 10;
                $current_trips->total_trip_amount = 10;
                $current_trips->actual_trip_travel_time = 10;
                $current_trips->payment_status = 0;
                $current_trips->trip_driver_rating = 2;
                $current_trips->trip_user_rating = 3;
                $current_trips->save();

                $response = array(
                    "data" => $UserRequest,
                    "error_code" => 0,
                    "message" => "Request Sent"
                );


            }
            else
            {
                $response = array(
                    "data" => '',
                    "error_code" => 1,
                    "message" => "Request Already Accept to Other Driver"
                );
            }
            return response()->json($response);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

}
