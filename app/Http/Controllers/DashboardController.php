<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Driver;
use App\DriverShippingAddress;
use App\DriverBankInfo;
use App\DriverDocument;
use Session;

class DashboardController extends Controller {

    public function store_document(Request $request) {

        $messages = [
            'required' => 'Your :attribute is required.'
        ];
        $validator = Validator::make($request->all(), [
                     'driving_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'insurance_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('login_driver_id');

        $image1 = $request->driving_license;
        $driving_license = $image1->store('documents');

        $image2 = $request->insurance_card;
        $insurance_card = $image2->store('documents');

        $DriverDocumentDetail = DriverDocument::where('driver_id', '=', $driver_id)->first();
        if ($DriverDocumentDetail == null) {
            $DriverDocument = new DriverDocument;
            $DriverDocument->driver_id = $driver_id;
            $DriverDocument->verification_document = $driving_license;
            $DriverDocument->autoissurance_document = $insurance_card;
            $DriverDocument->save();
        } else {
            $DriverDocument = DriverDocument::where('driver_id', '=', $driver_id)->update(['verification_document' => $driving_license, 'autoissurance_document' => $insurance_card]);
        }

        if ($driving_license != '' || $insurance_card != '') {
            return redirect()->back()->with('success', 'Documents uploaded successfully');
        } else {
            return redirect()->back()->with('danger', 'Please select file if you want to upload your documents');
        }
    }

    public function store_profile_data(Request $request) {
        $messages = [
            'required' => 'Your :attribute is required.',
            'name' => 'required|alpha',
            'lastname' => 'required|alpha',
            'email' => 'required|email'
        ];
        $validator = Validator::make($request->all(), [
                    'name.required' => 'Your firstname is required.',
                    'name.alpha' => 'The firstname may only contain letters.',
                    'lastname.required' => 'Your firstname is required.',
                    'lastname.alpha' => 'The firstname may only contain letters.',
                    'email.required' => 'We need to know your e-mail address!',
//                    'profile_pic' => 'required|mimes:jpeg,jpg,gif,png|file|max:500|dimensions:min_width=100,min_height=200'
                    'profile_pic' => 'mimes:jpeg,jpg,gif,png'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('login_driver_id');

        $driver_data = Driver::firstOrNew(array('id' => $driver_id));

        $profile_pic = '';

        if ($request->file('profile_pic')) {
            $image = $request->file('profile_pic')->getPathName();
            $profile_pic = file_get_contents($image);
            $driver_data->profile_pic = $profile_pic;
        }

        $driver_data->name = $request->input('name');
        $driver_data->lastname = $request->input('lastname');
        $driver_data->email = $request->input('email');
        $driver_data->save();
        if ($profile_pic != '' || $request->input('lastname') != '' || $request->input('email') != '' || $request->input('name') != '') {
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('danger', 'Nothing to change in your profile');
        }
    }

    public function store_driver_type(Request $request) {
        $messages = [
            'car_size.required' => 'Car size is required.',
            'transmission.required' => 'Transmission is required.'
        ];
        $validator = Validator::make($request->all(), [
                    'car_size' => 'required',
                    'transmission' => 'required'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $car_size = $request->input('car_size');
        $transmission = $request->input('transmission');
        $driver_id = $request->session()->get('login_driver_id');

        $driver = Driver::find($driver_id);
        $driver->is_sedan = 0;
        $driver->is_suv = 0;
        $driver->is_van = 0;
        $driver->is_auto = 0;
        $driver->is_manual = 0;
        if (@$car_size['is_sedan'] != '') {
            $driver->is_sedan = $car_size['is_sedan'];
        }if (@$car_size['is_suv'] != '') {
            $driver->is_suv = $car_size['is_suv'];
        }if (@$car_size['is_van'] != '') {
            $driver->is_van = $car_size['is_van'];
        }if (@$transmission['is_auto'] != '') {
            $driver->is_auto = $transmission['is_auto'];
        }if (@$transmission['is_manual'] != '') {
            $driver->is_manual = $transmission['is_manual'];
        }
        $driver->save();
        if ($car_size) {
            return redirect()->back()->with('success', 'Driver type updated successfully');
        } else {
            return redirect()->back()->with('danger', 'Driver type updated failed');
        }
    }

    public function store_bank_info(Request $request) {
        $messages = [
            'required' => 'Your :attribute is required.',
            'numeric' => 'The :attribute must be a number.',
            'alpha_num' => 'The :attribute must be a alpha numeric.'
        ];
        $validator = Validator::make($request->all(), [
                    'account_number' => 'required|alpha_num',
                    'routing_number' => 'required|numeric',
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('login_driver_id');
        $input['driver_id'] = $driver_id;
        $input['routing_number'] = base64_encode($request->input('routing_number'));
        $input['account_number'] = base64_encode($request->input('account_number'));

        $driver_bank_info = DriverBankInfo::where('driver_id', '=', $driver_id)->first();

        if ($driver_bank_info != '') {
            $id = $driver_bank_info->id;
            $driver_bank = DriverBankInfo::find($id);
            $driver_bank->routing_number = $input['routing_number'];
            $driver_bank->account_number = $input['account_number'];
            $driver_bank->save();
            return redirect()->back()->with('success', 'Bank information added successfully');
        } else {
            DriverBankInfo::create($input);
            return redirect()->back()->with('success', 'Bank information added successfully');
        }
    }

}
