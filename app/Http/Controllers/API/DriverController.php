<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Driver;
use App\DriverLocation;
use App\Helpers\Response\ResponseHelper;

class DriverController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function getDetails(Request $request) {
        try {
            $profile_stage = 0;
            $driver = $request->user('driver');
            $response = [];
            $response['id'] = $driver->id;
            $response['contact_number'] = $driver->contact_number;
            $response['email'] = $driver->email;
            $response['name'] = $driver->name;
            $response['lastname'] = $driver->lastname;
            $response['is_agreed'] = $driver->is_agreed;
            $response['is_approve'] = $driver->is_approve;
            $response['promocode'] = $driver->promocode;
            $response['profile_status'] = (int) $driver->profile_status;
            $response['personal_information'] = (object) [];
            if ($driver->legal_firstname || $driver->legal_lastname || $driver->legal_middlename || $driver->legal_lastname) {

                $response['personal_information'] = [
                    "legal_firstname" => $driver->legal_firstname,
                    "legal_middlename" => $driver->legal_middlename,
                    "legal_lastname" => $driver->legal_lastname,
                    "social_security_number" => $driver->social_security_number,
                ];
            }
            $response['shipping_adress'] = ($driver->shipping_address == null) ? (object) [] : $driver->shipping_address;
            if ($driver->documents) {
                $driver->documents->verification_document = ($driver->documents->verification_document) ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver->documents->verification_document : "";
                $driver->documents->autoissurance_document = ($driver->documents->autoissurance_document) ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver->documents->autoissurance_document : "";
                $driver->documents->homeissurance_document = ($driver->documents->homeissurance_document) ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver->documents->homeissurance_document : "";
                $driver->documents->uberpaycheck_document = ($driver->documents->uberpaycheck_document) ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver->documents->uberpaycheck_document : "";
            }
            $response['documents'] = ($driver->documents == null) ? (object) [] : $driver->documents;
            $response['bank_information'] = ($driver->bank_information == null) ? (object) [] : $driver->bank_information;
            $response['profile_pic'] = ($driver->profile_pic) ? $driver->profile_pic : "" ;
            $response['type'] = [
                "is_sedan" => $driver->is_sedan,
                "is_suv" => $driver->is_suv,
                "is_van" => $driver->is_van,
                "is_auto" => $driver->is_auto,
                "is_manual" => $driver->is_manual,
            ];
            return ResponseHelper::getResponse($response, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

    public function updateDriver(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'lastname' => 'required',
                        'email' => 'required',
                        'is_agreed' => 'required|integer',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
//            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            $driver = $request->user('driver');
            $driver->name = $request->name;
            $driver->lastname = $request->lastname;
            $driver->email = $request->email;
            $driver->promocode = $request->promocode;
            $driver->is_agreed = $request->is_agreed;
            if ($request->is_agreed == 1) {
                $driver->profile_status = ($driver->profile_status < 1) ? 1 : (int)$driver->profile_status;
            }
            $driver->save();
            $this->data = array('profile_status' => $driver->profile_status);
            $this->errors = [["Profile saved."]];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

    public function updateDriverPersonalInformation(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                        'legal_firstname' => 'required',
                        'legal_lastname' => 'required',
                        // 'legal_middlename' => 'required',
                        'dob' => 'bail|date|date_format:m-d-Y'
            ]);

            $dob = date('Y-m-d', strtotime($request->dob));

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
//            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            $driver = $request->user('driver');
            $driver->legal_firstname = $request->legal_firstname;
            $driver->legal_middlename = $request->legal_middlename;
            $driver->legal_lastname = $request->legal_lastname;
            $driver->social_security_number = $request->social_security_number;
            $driver->dob = $dob;
            $driver->profile_status = ($driver->profile_status < 2) ? 2 : (int)$driver->profile_status;
            $driver->save();
            $this->data = array('profile_status' => $driver->profile_status);
            $this->errors = [["Personal information saved."]];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

    public function updateDriverType(Request $request) {
        try {

            $validator = Validator::make($request->all(), [
                        'is_sedan' => 'required|integer',
                        'is_suv' => 'required|integer',
                        'is_van' => 'required|integer',
                        'is_auto' => 'required|integer',
                        'is_manual' => 'required|integer',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
//            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            $driver = $request->user('driver');
            $driver->is_sedan = $request->is_sedan;
            $driver->is_suv = $request->is_suv;
            $driver->is_van = $request->is_van;
            $driver->is_auto = $request->is_auto;
            $driver->is_manual = $request->is_manual;
            $driver->profile_status = ($driver->profile_status < 6) ? 6 : (int)$driver->profile_status;
            $driver->save();
            $this->data = array('profile_status' => (int)$driver->profile_status);
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
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

            $driver = $request->user('driver');
            $driver->profile_pic = $filename;
            $driver->profile_status = ($driver->profile_status < 7) ? 7 : (int)$driver->profile_status;
            $driver->save();
            // dd($filename);
            $this->data = array('profile_status' => (int)$driver->profile_status,'filename' => $filename);
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors[][] = $e->getMessage();
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

}
