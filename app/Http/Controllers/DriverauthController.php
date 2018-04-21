<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Driver;
use App\User;
use Twilio;
use Session;

class DriverauthController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('landingpage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if ($request->type == 'user') {

            $messages = [
                'contact_number.required' => 'Your phone number is required.',
                'contact_number.min' => 'The phone number must be at least 11.',
                'contact_number.numeric' => 'The phone number must be a number.',
                'contact_number.unique' => 'The phone number has been already registered.',
            ];
            $validator = Validator::make($request->all(), [
                        'contact_number' => 'required|min:11|numeric|unique:users',
                            ], $messages);


            $errors = $validator->errors();
            if ($validator->fails()) {
                return redirect()->back()
                                ->withInput($request->all())
                                ->withErrors($errors);
                exit;
            }
            $contact_number = $request->contact_number;
            //$us = str($contact_number, '+');
            if (strpos($contact_number, '+') !== 0) {
                $contact_number = '+1' . $request->contact_number;
            }

            $input['contact_number'] = $contact_number;
            $user = User::create($input);
            $user = User::find($user->id);
            //For temporary (Twilio package has some php warning so didable it for smooth run)
            error_reporting(E_ERROR | E_WARNING | E_PARSE);

            try {
                $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');
                $encrypted_id = openssl_encrypt($user->id, "AES-128-ECB", $ENCRYPTION_KEY);
                Twilio::message($user->contact_number, "Welcome to Greego, here is the link fot download GREEGO User app");
                return redirect()->route('user.show', ['id' => $encrypted_id]);
            } catch (\Exception $e) {
                if ($e->getCode() == 21211) {
                    return redirect()->back()->withErrors(['contact_number' => 'Please enter valid number.']);
                }
            }
        } if ($request->type == 'driver') {

            $messages = [
                'required' => 'Your :attribute is required.',
                'integer' => 'Phone number is must be number.',
                'name.required' => 'Your firstname is required.',
                'name.alpha' => 'The firstname may only contain letters.',
                'lastname.required' => 'Your firstname is required.',
                'lastname.alpha' => 'The firstname may only contain letters.',
                'contact_number.required' => 'Your phone number is required.',
                'contact_number.min' => 'The phone number must be at least 11.',
                'contact_number.numeric' => 'The phone number must be a number.',
                'contact_number.unique' => 'The phone number has been already registered.',
                'email.required' => 'Your email is required.'
            ];
            $validator = Validator::make($request->all(), [
                        'contact_number' => 'required|min:11|numeric|unique:drivers',
                        'name' => 'required|alpha',
                        'lastname' => 'required|alpha',
                        'email' => 'required|email',
                        'city' => 'required|alpha'
                            ], $messages);
            $errors = $validator->errors();
            if ($validator->fails()) {
                return redirect()->back()
                                ->withInput($request->all())
                                ->withErrors($errors);
                exit;
            }
            $input = $request->all();
            $contact_number = $request->contact_number;
            // $us = strpos($contact_number, '+');
//            echo strpos($contact_number, '+');exit;
            if (strpos($contact_number, '+') !== 0) {
                $contact_number = '+1' . $request->contact_number;
            }

            $input['contact_number'] = $contact_number;

            $driver = Driver::create($input);
            $driver = Driver::find($driver->id);

            $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');
            $encrypted_id = openssl_encrypt($driver->id, "AES-128-ECB", $ENCRYPTION_KEY);
//            $decrypted_id = openssl_decrypt($encrypted_id, "AES-128-ECB", $ENCRYPTION_KEY);

            return redirect()->route('driver.show', ['id' => $encrypted_id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');

        $decrypted_id = openssl_decrypt($id, "AES-128-ECB", $ENCRYPTION_KEY);

        $driver = Driver::find($decrypted_id);
        return view('verification', array('id' => $id, 'contact_number' => $driver->contact_number));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');

        $decrypted_id = openssl_decrypt($id, "AES-128-ECB", $ENCRYPTION_KEY);

        $driver = Driver::find($decrypted_id);
        $login_otp = $request->session()->get('verify_otp');
        return view('verifyotp', array('id' => $id, 'contact_number' => $driver->contact_number, "login_otp" => $login_otp));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $messages = [
            'contact_number.required' => 'Your phone number is required.',
            'contact_number.min' => 'The phone number must be at least 11.',
            'contact_number.numeric' => 'The phone number must be a number.',
            'contact_number.unique' => 'The phone number has been already registered.'
        ];
        $validator = Validator::make($request->all(), [
                    'contact_number' => 'required|min:11|numeric'], $messages);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }


        $contact_number = $request->contact_number;
        $us = strpos($contact_number, '+1');
        $in = strpos($contact_number, '+91');
        if ($us == '' && $in != '') {
            $contact_number = '+1' . $request->contact_number;
        }

        $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');

        $decrypted_id = openssl_decrypt($id, "AES-128-ECB", $ENCRYPTION_KEY);

        $driver = Driver::find($decrypted_id);
        $request->session()->forget('verify_otp');
        $otp = rand(100000, 999999);
        Session::put('verify_otp', $otp);
        Driver::where('id', '=', $decrypted_id)->update(['contact_number' => $contact_number]);
        //For temporary (Twilio package has some php warning so didable it for smooth run)
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        try {
            Twilio::message($contact_number, "Your Greego code is " . $otp);
            return redirect()->route('driver.edit', ['id' => $id]);
        } catch (\Exception $e) {
            if ($e->getCode() == 21211) {
                return redirect()->back()->withErrors(['contact_number' => 'Please enter valid number.']);
            }
        }
    }

    public function verify_otp(Request $request, $id) {
        $messages = [
            'otp.required' => 'OTP code is required.',
            'otp.digits' => 'The OTP code must be at least 6.',
            'otp.numeric' => 'The OTP code must be a number.',
        ];
        $validator = Validator::make($request->all(), [
                    'otp' => 'required|digits:6|numeric'], $messages);
//        $validator = Validator::make($request->all(), [
//                    'otp' => ['required', 'min:4', 'numeric',
//                        function($attribute, $value, $fail) {
//                            $drivers = Driver::find(17);
//                            $db_otp = $drivers->otp;
//                            if ($value == $db_otp) {
//                                return $fail($attribute . ' is invalid.');
////                                return redirect()->route('driver.edit', ['id' => $id]);
//                                exit;
//                            }
//                        }]], $messages);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }
          $ENCRYPTION_KEY = config('constants.ENCRYPTION_KEY');

        $decrypted_id = openssl_decrypt($id, "AES-128-ECB", $ENCRYPTION_KEY);

        
        
        $driver = Driver::find($decrypted_id);
        $verify_otp = $request->session()->get('verify_otp');
        if ($request->input('otp') == $verify_otp) {
            $request->session()->forget('verify_otp');
            $driver->verified = 1;
            $driver->profile_status = 1;
            $driver->save();
            Session::put('driver_id', $decrypted_id);
            return redirect()->route('driverinfo.personal_info');
        } else {
//            $request->session()->forget('verify_otp');
//            $driver->verified = 1;
//            $driver->profile_status = 1;
//            $driver->save();
//            Session::put('driver_id', $id);
//            return redirect()->route('driverinfo.personal_info');
            return redirect()->back()->withInput($request->all())->withErrors(['otp' => 'The OTP code is not matched.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
