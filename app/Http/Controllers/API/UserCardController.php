<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Response\ResponseHelper;
use Validator;
use App\UserCard;
use Twilio;

class UserCardController extends Controller {

    public $errorCode = 0;
    public $errors = [];
    public $data = [];
    
    public function UserCard(Request $request)
    {
        try
        {

            $validator = Validator::make($request->all(), [
                'card_number' => 'required',
                'exp_month_year' => 'required',
                'zipcode' => 'required',
            ]);
            
            if ($validator->fails()) {
                $this->errors = $validator->errors()->getMessages();
                $this->errorCode = 1;
                return ResponseHelper::getResponse($this->data, $this->errorCode, $this->errors);
                exit;
            }

            $user = auth()->user();

            $card_number = base64_encode($request->post('card_number'));

            $UserCard = new UserCard;
            $UserCard->user_id = $user->id;
            $UserCard->card_number = $card_number;
            $UserCard->exp_month_year = $request->post('exp_month_year');
            $UserCard->zipcode = $request->post('zipcode');
            $UserCard->save();
            $UserCard->card_number = $request->post('card_number');

            $response = array(
                    "data" => $UserCard,
                    "error_code" => 0,
                    "message" => "User Card Saved"
                );
        }
        catch (\Exception $e) {
            $response = array(
                    "data" => [],
                    "error_code" => 1,
                    "message" => "User Card Failed"
                );            
        }
        return response()->json($response);
    }

    
}
