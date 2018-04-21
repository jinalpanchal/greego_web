<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Response\ResponseHelper;
use Validator;
use App\DriverShippingAddress;
use App\DriverBankInfo;
use App\DriverDocument;
use Twilio;

class DriverShippingAddressController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];

    public function DriverShippingAddress(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'street' => 'required',
                        'apt' => 'required',
                        'city' => 'required',
                        'zipcode' => 'required|integer',
                        'state' => 'required',
            ]);

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $driver = $request->user('driver');
            $DriverShippingAddress = DriverShippingAddress::firstOrNew(array('driver_id' => $driver->id));
            $DriverShippingAddress->driver_id = $driver->id;
            $DriverShippingAddress->street = $request->post('street');
            $DriverShippingAddress->apt = $request->post('apt');
            $DriverShippingAddress->city = $request->post('city');
            $DriverShippingAddress->zipcode = $request->post('zipcode');
            $DriverShippingAddress->state = $request->post('state');
            $DriverShippingAddress->save();

            $driver->profile_status = ($driver->profile_status < 3) ? 3 : (int) $driver->profile_status;
            $driver->save();

            $data = array('profile_status' => (int) $driver->profile_status);
            $response = array(
                "data" => $data,
                "error_code" => 0,
                "message" => "Shipping Address Saved."
            );
        } catch (\Exception $e) {
            $response = array(
                "data" => [],
                "error_code" => 1,
                "message" => "Shipping Address Failed. " . $e->getMessage()
            );
        }
        return response()->json($response);
    }

    public function DriverBankInfo(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                        'account_number' => 'required',
                        'routing_number' => 'required',
            ]);

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $driver = $request->user('driver');
            $driver->profile_status = ($driver->profile_status < 5 ) ? 5 : (int) $driver->profile_status;
            $driver->save();
            $account_number = base64_encode($request->post('account_number'));
            $DriverBankInformation = DriverBankInfo::where('driver_id', '=', $driver->id)->first();
            if ($DriverBankInformation == null) {
                $DriverBankInfo = new DriverBankInfo;
                $DriverBankInfo->driver_id = $driver->id;
                $DriverBankInfo->routing_number = $request->post('routing_number');
                $DriverBankInfo->account_number = $account_number;
                $DriverBankInfo->save();
            } else {
                $DriverBankInfo = DriverBankInfo::where('driver_id', '=', $driver->id)->update(['routing_number' => $request->post('routing_number'), 'account_number' => $account_number]);
            }
            $data = array('profile_status' => (int) $driver->profile_status);
            $response = array(
                "data" => $data,
                "error_code" => 0,
                "message" => "Bank Information Save"
            );
            
        } catch (\Exception $e) {
            $response = array(
                "data" => [],
                "error_code" => 1,
                "message" => "No records right now"
            );
        }
        return response()->json($response);
    }

    public function DriverDocument(Request $request) {

        try {
            ini_set('max_execution_time', 0);

            $validator = Validator::make($request->all(), [
                        'driving_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                        'insurance_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                        'home_insurance' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
                        'current_driver' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            ]);

            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                //            return $this->getResponse($this->data, $this->errorCode, $this->errors);
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $driver = $request->user('driver');
            $driver->profile_status = ($driver->profile_status < 4 ) ? 4 : (int) $driver->profile_status;
            $driver->save();
            $image1 = $request->driving_license;
            $driving_license = $image1->store('documents');


            $image2 = $request->insurance_card;
            $insurance_card = $image2->store('documents');
            $home_insurance = '';
            if ($request->file('home_insurance')) {
                $image3 = $request->home_insurance;
                $home_insurance = $image3->store('documents');
            }
            $current_driver = '';
            if ($request->file('current_driver')) {
                $image4 = $request->current_driver;
                $current_driver = $image4->store('documents');
            }

//            $DriverDocumentDetail = DriverDocument::where('driver_id', '=', $driver->id)->first();
            $DriverDocument = DriverDocument::firstOrNew(array('driver_id' => $driver->id));
            $DriverDocument->driver_id = $driver->id;
            $DriverDocument->verification_document = $driving_license;
            $DriverDocument->autoissurance_document = $insurance_card;
            $DriverDocument->homeissurance_document = $home_insurance;
            $DriverDocument->uberpaycheck_document = $current_driver;
            $DriverDocument->save();
            
            $data = array('profile_status' => (int) $driver->profile_status);
            $response = array(
                "data" => $data,
                "error_code" => 0,
                "message" => "Document Saved"
            );
        } catch (\Exception $e) {
            $response = array(
                "data" => [],
                "error_code" => 1,
                "message" => "Document upload failed " . $e->getMessage()
            );
        }
        return response()->json($response);
    }

}
