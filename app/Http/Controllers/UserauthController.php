<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Twilio;

class UserauthController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('signupride');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//        $messages = [
//            'contact_number.required' => 'Your phone number is required.',
//            'contact_number.min' => 'The phone number must be at least 11.',
//            'contact_number.numeric' => 'The phone number must be a number.',
//            'contact_number.unique' => 'The phone number has already been registered.',
//        ];
//        $validator = Validator::make($request->all(), [
//                    'contact_number' => 'required|min:11|numeric|unique:users',
//                        ], $messages);
//
//
//        $errors = $validator->errors();
//        if ($validator->fails()) {
//            return redirect()->to('/user')
//                            ->withInput($request->all())
//                            ->withErrors($errors);
//            exit;
//        }
//
//        $input = $request->all();
//        $user = User::create($input);
//        $user = User::find($user->id);
//        //For temporary (Twilio package has some php warning so didable it for smooth run)
//        error_reporting(E_ERROR | E_WARNING | E_PARSE);
//
//        try {
//            Twilio::message($user->contact_number, "Welcome to Greego, here is the link fot download GREEGO User app");
//            return redirect()->route('user.show', ['id' => $user->id]);
//        } catch (\Exception $e) {
//            if ($e->getCode() == 21211) {
//                return redirect()->back()->withErrors(['contact_number' => 'Please enter valid number.']);
//            }
//        }
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

        $user = User::find($decrypted_id);
        return view('download_app', array('id' => $id, 'contact_number' => $user->contact_number));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
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
