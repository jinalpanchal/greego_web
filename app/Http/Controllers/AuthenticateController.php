<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Driver;
use App\DriverShippingAddress;
use App\DriverBankInfo;
use App\DriverDocument;
use Twilio;
use Session;

class AuthenticateController extends Controller {

    public function index() {
        return view('login');
    }

    public function auth(Request $request) {

        $request->session()->flush();
        $messages = [
            'contact_number.required' => 'Your phone number is required.',
            'contact_number.min' => 'The phone number must be at least 11.',
            'contact_number.numeric' => 'The phone number must be a number.'
        ];
        $validator = Validator::make($request->all(), [
                    'contact_number' => 'required|min:11|numeric',
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }


        $contact_number = $request->input('contact_number');
        if (strpos($contact_number, '+') !== 0) {
            $contact_number = '+1' . $request->contact_number;
        }
        Session::put('contact_number', $contact_number);
        $otp = rand(100000, 999999);
        Session::put('login_otp', $otp);

        $driver = Driver::where('contact_number', '=', $contact_number)->first();
        $user = User::where('contact_number', '=', $contact_number)->first();
        if ($driver !== null) {
            if ($driver['profile_status'] != 7) {
                Session::put('driver_id', $driver['id']);
                return redirect()->route('driverinfo.personal_info');
                exit;
            }
            if ($driver['id']) {
                $driver_id = $driver['id'];
                //Session::put('login_driver_id', $driver_id);
            }
        } if ($user !== null) {
            if ($user['id']) {

                $user_id = $user['id'];
                // Session::put('login_user_id', $user_id);
            }
        } else {
            return redirect()->back()->withErrors(['contact_number' => 'Please enter valid number.']);
        }

        //For temporary (Twilio package has some php warning so didable it for smooth run)
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        try {
//            Twilio::message($contact_number, "Hello this is otp " . $otp);
            return redirect()->route('login.show_verify');
        } catch (\Exception $e) {
            if ($e->getCode() === 21211) {
                return redirect()->back()->withErrors(['contact_number' => 'Please enter valid number.']);
            }
        }
    }

    public function show_verify(Request $request) {
        $viewdata['login_otp'] = $request->session()->get('login_otp');
        $viewdata['contact_number'] = $request->session()->get('contact_number');
        return view('loginotp', $viewdata);
    }

    public function login_otp(Request $request) {
        $messages = [
            'otp.required' => 'OTP code is required.',
            'otp.digits' => 'The OTP code must be at least 6.',
            'otp.numeric' => 'The OTP code must be a number.',
        ];
        $validator = Validator::make($request->all(), [
                    'otp' => 'required|digits:6|numeric'], $messages);

        $errors = $validator->errors();

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }
        $verify_otp = $request->session()->get('login_otp');

        if ($request->input('otp') == $verify_otp) {
            $request->session()->forget('login_otp');

            $contact_number = $request->session()->get('contact_number');
            $driver = Driver::where('contact_number', '=', $contact_number)->first();
            $user = User::where('contact_number', '=', $contact_number)->first();

            if ($driver !== null) {
                if ($driver['profile_status'] != 7) {
                    Session::put('driver_id', $driver['id']);
                    return redirect()->route('driverinfo.personal_info');
                    exit;
                }
                if ($driver['id']) {
                    $driver_id = $driver['id'];
                    Session::put('login_driver_id', $driver_id);
                }
            } if ($user !== null) {
                if ($user['id']) {
                    $user_id = $user['id'];
                    Session::put('login_user_id', $user_id);
                }
            }
            return redirect()->route('account.account_dashboard', 'dashboard');
        } else {

            $request->session()->forget('login_otp');
            $contact_number = $request->session()->get('contact_number');
            $driver = Driver::where('contact_number', '=', $contact_number)->first();
            $user = User::where('contact_number', '=', $contact_number)->first();

            if ($driver !== null) {
                if ($driver['profile_status'] != 7) {
                    Session::put('driver_id', $driver['id']);
                    return redirect()->route('driverinfo.personal_info');
                    exit;
                }
                if ($driver['id']) {
                    $driver_id = $driver['id'];
                    Session::put('login_driver_id', $driver_id);
                }
            } if ($user !== null) {
                if ($user['id']) {
                    $user_id = $user['id'];
                    Session::put('login_user_id', $user_id);
                }
            }
            return redirect()->route('account.account_dashboard', 'dashboard');
//            return redirect()->back()->withInput($request->all())->withErrors(['otp' => 'The OTP code is not matched.']);
        }
    }

    public function account(Request $request, $section) {

        $data = $request->session()->all();
        $id = $request->session()->get('login_driver_id');

        $viewdata['profile'] = array();
        if ($id != '') {
            $viewdata['profile'] = Driver::find($id);
        }
        $user_id = $request->session()->get('login_user_id');

        if ($user_id != '') {
            $viewdata['profile'] = User::find($user_id);
        }
        if ($section == '') {
            $section = 'dashboard';
        }
        switch ($section):
            case 'dashboard':
                $viewdata['active_menu'] = 'dashboard';
                return view('dashboard', $viewdata);
                break;
            case 'driving_history':
                $viewdata['active_menu'] = 'driving_history';
                return view('dashboard', $viewdata);
                break;
            case 'documents':
                $driver_doc = DriverDocument::where('driver_id', '=', $id)->first();
                if ($driver_doc !== null) {
                    $viewdata['license'] = $driver_doc->verification_document ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver_doc->verification_document : "";
                    $viewdata['insurance'] = $driver_doc->autoissurance_document ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $driver_doc->autoissurance_document : "";
                }
                $viewdata['active_menu'] = 'documents';
                return view('web_dashboard/documents', $viewdata);
                break;
            case 'payment':
                $driver_bank_info = DriverBankInfo::where('driver_id', '=', $id)->first();
                if ($driver_bank_info !== null) {
                    $viewdata['driver_bank_info'] = $driver_bank_info;
                }

                $viewdata['active_menu'] = 'payment';
                return view('web_dashboard/payment', $viewdata);
                break;
            case 'reward':
                $viewdata['active_menu'] = 'reward';
                return view('dashboard', $viewdata);
                break;
            case 'setting':
                $viewdata['active_menu'] = 'setting';
                return view('web_dashboard/setting', $viewdata);
                break;
            case 'user_history':
                $viewdata['active_menu'] = 'user_history';
                return view('dashboard', $viewdata);
                break;

            default :
                break;
        endswitch;
    }

    public function Logout(Request $request) {
        $request->session()->flush();
        return redirect()->route('home');
    }

}
