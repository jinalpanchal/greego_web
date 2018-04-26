<?php

namespace App\Http\Controllers;
            
use Illuminate\Http\Request;
use Validator;
use App\Driver;
use App\DriverShippingAddress;
use App\DriverBankInfo;
use App\DriverDocument;
use Session;

class DriverInfoController extends Controller {

    public function personal_info(Request $request) {
//        Session::put('driver_id', 1);
        $data = $request->session()->all();
        $id = $request->session()->get('driver_id');
        $viewdata['profile'] = Driver::find($id);
        $profile_status = $viewdata['profile']->profile_status;
        $percentage = 0;
        switch ($profile_status):
            case 0:
                $percentage = 14;
                break;
            case 1:
                $percentage = 28;
                break;
            case 2:
                $percentage = 42;
                break;
            case 3:
                $percentage = 57;
                break;
            case 4:
                $percentage = 71;
                break;
            case 5:
                $percentage = 85;
                break;
            case 6:
                $percentage = 100;
                break;
            case 7:
                $percentage = 100;
                break;
            default :
                $percentage = 0;
                break;
        endswitch;

        $viewdata['percentage'] = $percentage;
        return view('information', $viewdata);
    }

    public function store_personal_info(Request $request) {
//dd($request);
        $messages = [
            'required' => 'Your :attribute is required.',
            'alpha' => 'Your :attribute may only contain letters.',
            'numeric' => 'The :attribute must be a number.',
        ];
        $validator = Validator::make($request->all(), [
                    'legal_first_name' => 'required|alpha',
                    'middle_name' => 'nullable|alpha',
                    'legal_last_name' => 'required|alpha',
                    'social_security_number' => 'required|alpha_dash',
                    'month' => 'required',
                    'date' => 'required',
                    'year' => 'required'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('driver_id');
        $driver = Driver::find($driver_id);
        $driver->legal_firstname = $request->input('legal_first_name');
        $driver->legal_middlename = $request->input('middle_name');
        $driver->legal_lastname = $request->input('legal_last_name');
        $driver->social_security_number = $request->input('social_security_number');
        $date = $request->input('year') . '-' . $request->input('month') . '-' . $request->input('date');
        $dob = date('Y-m-d', strtotime($date));
        $driver->profile_status = 2;
        $driver->dob = $dob;
        $driver->save();
        return redirect()->back()->with('success', 'Personal information added successfully.');
    }

    public function store_shipping_address(Request $request) {
        $messages = [
            'required' => 'Your :attribute is required.',
            'alpha' => 'Your :attribute may only contain letters.',
            'numeric' => 'The :attribute must be a number.',
        ];
        $validator = Validator::make($request->all(), [
                    'address_1' => 'required',
                    'address_2' => 'nullable',
                    'city' => 'required',
                    'state' => 'required',
                    'zipcode' => 'required|digits_between:4,6',
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('driver_id');
        $input['driver_id'] = $driver_id;
        $input['street'] = $request->input('address_1');
        $input['apt'] = $request->input('address_2');
        $input['city'] = $request->input('city');
        $input['state'] = $request->input('state');
        $input['zipcode'] = $request->input('zipcode');
        DriverShippingAddress::create($input);

        $driver = Driver::find($driver_id);
        $driver->profile_status = 3;
        $driver->save();

        return redirect()->back()->with('success', 'Shipping address added successfully.');
    }

    public function store_driver_document(Request $request) {

        $messages = [
            'required' => 'Your :attribute is required.'
        ];
        $validator = Validator::make($request->all(), [
                    'driving_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'insurance_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'home_insurance' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
                    'current_driver' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

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
        $driver_id = $request->session()->get('driver_id');
        $DriverDocumentDetail = DriverDocument::where('driver_id', '=', $driver_id)->first();
        if ($DriverDocumentDetail == null) {
            $DriverDocument = new DriverDocument;
            $DriverDocument->driver_id = $driver_id;
            $DriverDocument->verification_document = $driving_license;
            $DriverDocument->autoissurance_document = $insurance_card;
            $DriverDocument->homeissurance_document = $home_insurance;
            $DriverDocument->uberpaycheck_document = $current_driver;
            $DriverDocument->save();
        } else {
            $DriverDocument = DriverDocument::where('driver_id', '=', $driver_id)
                    ->update(['verification_document' => $driving_license, 'autoissurance_document' => $insurance_card, 'homeissurance_document' => $home_insurance, 'uberpaycheck_document' => $current_driver]);
        }

        $driver = Driver::find($driver_id);
        $driver->profile_status = 4;
        $driver->save();
        return redirect()->back()->with('success', 'Documents uploaded successfully.');
    }

    public function store_bank_info(Request $request) {
        $messages = [
            'required' => 'Your :attribute is required.',
            'numeric' => 'The :attribute must be a number.',
            'alpha_num' => 'The :attribute must be a alpha numeric.'
        ];
        $validator = Validator::make($request->all(), [
                    'account_number' => 'required|alpha_num|digits_between:10,16',
                    'routing_number' => 'required|numeric|digits_between:2,9',
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('driver_id');
        $input['driver_id'] = $driver_id;
        $input['routing_number'] = base64_encode($request->input('routing_number'));
        $input['account_number'] = base64_encode($request->input('account_number'));

        DriverBankInfo::create($input);

        $driver = Driver::find($driver_id);
        $driver->profile_status = 5;
        $driver->save();

        return redirect()->back()->with('success', 'Bank information added successfully.');
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
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $car_size = $request->input('car_size');
        $transmission = $request->input('transmission');
        $driver_id = $request->session()->get('driver_id');

        $driver = Driver::find($driver_id);

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
        $driver->profile_status = 6;
        $driver->save();
        return redirect()->back()->with('success', 'Driver Type added successfully.');
    }

    public function store_profile_photo(Request $request) {

        $messages = [
            'required' => 'Your :attribute is required.'
        ];
        $validator = Validator::make($request->all(), [
//                    'profile_pic' => 'required|mimes:jpeg,jpg,gif,png|file|max:500|dimensions:min_width=100,min_height=200'
                    'profile_pic' => 'required|mimes:jpeg,jpg,gif,png|file'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/driverinfo/personal_info')
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $image = $request->profile_pic;
        $profile_pic = $image->store('profile_pic');

//        $request->file('profile_pic')->getClientSize();
//
//        $image = $request->file('profile_pic')->getPathName();
//        $profile_pic = file_get_contents($image);

        $driver_id = $request->session()->get('driver_id');
        $driver = Driver::find($driver_id);
        $driver->profile_pic = $profile_pic;
        $driver->profile_status = 7;
        $driver->save();
        return redirect()->back()->with('success', 'Profile photo uploaded successfully.');
    }

    public function done(Request $request) {

        $request->session()->forget('driver_id');
        return redirect()->route('home');
    }

}
