<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\UsaState;
use App\Helpers\Response\ResponseHelper;

class RatesController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function getRates(Request $request) {
        try {
            $user = auth()->user();
            $validator = Validator::make($request->all(), [
                        'state' => 'required',
            ]);
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }
            
            $state = $request->state;
            $UsaRates = UsaState::where('state_name',$state)->first();
            if(@$UsaRates->rates == null ){
                $UsaRates = UsaState::where('state_name','New York')->first(); //defualt it will give rates fror NY(New York)
            }
            $this->data = $UsaRates->rates;
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
            
        } catch (Exception $exc) {
            $this->errorCode = 1;
            $this->errors = [
                ["Somthing went wrong"]
            ];
            return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
        }
    }

}
