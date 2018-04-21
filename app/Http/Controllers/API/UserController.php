<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Storage;
use App\User;
use App\UserVehicle;
use App\UserCard;
use App\Driver;
use App\Helpers\Response\ResponseHelper;
use App\DriverLocation;
use App\Helpers\Notification\PushNotification;
class UserController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function getDetails() {
        try {
            $user = auth()->user();
            $user->cards;
            $user->vehicles;
            $user->profile_pic = $user->avatar();
            $this->data = $user->toArray();
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

    public function updateUser(Request $request) {
        $user = auth()->user();
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->lastname) {
            $user->lastname = $request->lastname;
        }
        if ($request->is_agreed !== null) {
            $user->is_agreed = $request->is_agreed;
        }
        $user->save();
        $this->data = $user;
        return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
    }

    public function addVehicle(Request $request) {

        $validator = Validator::make($request->all(), [
                    'vehicle_manufacturer_id' => 'required|integer',
                    'vehicle_id' => 'required|integer',
                    'type' => 'required|integer',
                    'year' => 'required|integer',
                    'color' => 'required',
                    'transmission_type' => 'required',
        ]);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->getMessages();
            $this->errorCode = 1;
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
            exit;
        }
        $user = auth()->user();
        $UserVehicle = new UserVehicle;
        $UserVehicle->user_id = $user->id;
        $UserVehicle->vehicle_id = $request->post('vehicle_id');
        $UserVehicle->type = $request->post('type');
        $UserVehicle->year = $request->post('year');
        $UserVehicle->color = $request->post('color');
        $UserVehicle->transmission_type = $request->post('transmission_type');
        $UserVehicle->save();
        $this->data = $UserVehicle;
        return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
//            $this->errorCode = 1;
//            $this->errors = [
//                ["Somthing went wrong"]
//            ];
//            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
    }

    public function addProfilePic(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            $image = $request->image;
            $filename = $image->store('profile_pic');

            $user = auth()->user();
            $user->profile_pic = $filename;
            $user->save();
            $this->data = $user;
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors[][] = $e->getMessage();
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

    public function getDrivers(Request $request) {
        $validator = Validator::make($request->all(), [
                    'lat' => 'required|between:0,99.99',
                    'lng' => 'required|between:0,99.99',
        ]);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->getMessages();
            $this->errorCode = 1;

            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
            exit;
        }

        


        $lat = (float)$request->post('lat');
        $lng = (float) $request->post('lng');
        $distance = 10;
        $results = DB::table('driverlocation')
       
//                ->selectRaw('id, ( 3959 * ACOS( COS( radians(37) ) * COS( radians( ' . $lat . ' ) ) * COS( radians( ' . $lng . ' ) - radians(-122) ) + SIN( radians(37) ) * SIN( radians( ' . $lat . ' ) ) ) ) AS distance')
                ->selectRaw(' id, driver_id, lat, lng, (
                            3959 * acos (
                            cos ( radians('.$lat.') )
                            * cos( radians( lat ) )
                            * cos( radians( lng ) - radians('.$lng.') )
                            + sin ( radians('.$lat.') )
                            * sin( radians( lat ) )
                          )
                      ) AS distance')
                ->havingRaw('distance < '.$distance)
                ->orderByRaw('distance DESC')
                ->get();
        $this->data = $results;

        // $driver_detail = $results->toArray();
        // // dd($driver_detail);

        //    $msg = array(
        //        'body' => 'Hello',
        //        'title' => 'Test Notification',
        //        'icon' => 'myicon',
        //        'sound' => 'mySound'
        //    );
           
        //    foreach ($driver_detail as $d) {
        //     $driver_device_id = Driver::select('device_id')
        //         ->where('id', $d->driver_id)
        //         ->get()->toArray();     


        //         $device_ids = $driver_device_id[0]['device_id'];

        //         PushNotification::PushAndroidNotification($msg, $device_ids);
        //    }
           
       
        return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
    }

}
