<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\Driver;
use Twilio;
use App\Helpers\Response\ResponseHelper;

class AuthController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function loginFinal(Request $request) {
        $validator = Validator::make($request->all(), [
                    'contact_number' => 'required',
                    'is_iphone' => 'required|integer',
//                    'device_id' => 'required'
        ]);
        if ($validator->fails()) {
            $this->errors = $validator->errors()->getMessages();
            $this->errorCode = 1;
//            return $this->getResponse($this->data, $this->errorCode, $this->errors);
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
            exit;
        }
//        
//        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
//        $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
//
//
//        if ($iPhone) {
//            $input['is_iphone'] = 1;
//        } else {
//            $input['is_iphone'] = 0;
//        }
        $otp = rand(100000, 999999);
        $contact_number = $request->contact_number;
        $us = strpos($contact_number, '+');
        if ($us == '') {
            $contact_number = '+1' . $request->contact_number;
        }
        if ($request->user_type == 'driver') {
            $user = Driver::firstOrNew(array('contact_number' => $contact_number));
        } else {
            $user = User::firstOrNew(array('contact_number' => $contact_number));
        }
        $user->is_iphone = $request->is_iphone;
        $user->device_id = $request->device_id;
        $user->save();
        try {
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            Twilio::message($user->contact_number, "Your Greego code is " . $otp);
            $this->data = [
                "contact_number" => $user->contact_number,
                "is_agreed" => $user->is_agreed,
                "otp" => $otp,
                "token" => $user->createToken('MyApp')->accessToken
            ];
            if ($request->user_type == 'driver') {
                $this->data['profile_status'] = (int) $user->profile_status;
            }
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        } catch (\Exception $e) {
            $this->errorCode = 1;
            if ($e->getCode() == 21211) {
                $this->errors = [
                    ["Contact_numberNumber is invalid."]
                ];
            } else {
                $this->errors[][] = $e->getMessage();
            }
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

}
