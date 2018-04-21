<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\VehicleManufacturers;
use App\Vehicle;
use App\UserVehicle;
use App\Helpers\Response\ResponseHelper;

class VehicleController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function vehicleManufacturerslist(Request $request) {
        $vehicleManufactures = VehicleManufacturers::select('id', 'name')->get();
        $response = array(
            "data" => $vehicleManufactures,
            "error_code" => 0,
            "message" => "VehicleManufacturersanu List"
        );
        return response()->json($response);
    }

    public function vehicles(Request $request) {
        $validator = Validator::make($request->all(), [
                    'vehicle_manufacturer_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->getMessages();
            $this->errorCode = 1;
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
            exit;
        }
        $vehicles = Vehicle::select('id', 'model')
                ->where('vehicle_manufacturer_id', $request->vehicle_manufacturer_id)
                ->get();
        $this->data = $vehicles;
        $this->errorCode = 0;
        $this->errors = [];
        return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        return response()->json($response);
    }

    public function vehicleslist(Request $request) {

        try {
            $user = VehicleManufacturers::select('id', 'name')->with('vehicles')->get();
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


    public function selectVehicle(Request $request) {
        
        try {
            
            $validator = Validator::make($request->all(), [
                        'vehicle_id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $user = auth()->user();
            $vehicle_id = $request->post('vehicle_id');

            $UserVehicle = UserVehicle::where('user_id', '=', $user->id)->update(['selected' => 0]);
            // dd($UserVehicle );
            $UserVehicleSelected = UserVehicle::where('user_id', '=', $user->id)->where('vehicle_id', '=', $vehicle_id)->update(['selected' => 1]);

            $response = array(
                "data" => $UserVehicleSelected,
                "error_code" => 0,
                "message" => "User Vehicle Selected"
            );

        } catch (Exception $exc) {
            $response = array(
            "data" => '',
            "error_code" => 1,
            "message" => "User Vehicle Not Selected"
        );
        }
        return response()->json($response);
    }


    public function deleteVehicle(Request $request) {
        
        try {
            
            $validator = Validator::make($request->all(), [
                        'vehicle_id' => 'required|integer',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $user = auth()->user();
            $vehicle_id = $request->post('vehicle_id');

            // $UserVehicle = UserVehicle::where('user_id', '=', $user->id)->update(['selected' => 0]);
            
            $UserVehicleDelete = UserVehicle::where('user_id', '=', $user->id)->where('vehicle_id', '=', $vehicle_id)->delete();

            $response = array(
                "data" => $UserVehicleDelete,
                "error_code" => 0,
                "message" => "User Vehicle Deleted"
            );

        } catch (Exception $exc) {
            $response = array(
            "data" => '',
            "error_code" => 1,
            "message" => "User Vehicle Not Delected"
        );
        }
        return response()->json($response);
    }

}
