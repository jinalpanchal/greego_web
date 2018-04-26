<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Driver;
use App\User;
use App\DriverShippingAddress;
use App\DriverBankInfo;
use App\DriverDocument;
use App\UserRequest;
use App\current_trips;
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
            'name.required' => 'Your firstname is required.',
            'name.alpha' => 'The firstname may only contain letters.',
            'lastname.required' => 'Your firstname is required.',
            'lastname.alpha' => 'The firstname may only contain letters.',
            'email.required' => 'We need to know your e-mail address!',
//                    'profile_pic' => 'required|mimes:jpeg,jpg,gif,png|file|max:500|dimensions:min_width=100,min_height=200'
            'profile_pic' => 'mimes:jpeg,jpg,gif,png'
        ];
        $validator = Validator::make($request->all(), [
                    'required' => 'Your :attribute is required.',
                    'name' => 'required|alpha',
                    'lastname' => 'required|alpha',
                    'email' => 'required|email'
                        ], $messages);


        $errors = $validator->errors();
        if ($validator->fails()) {
            return redirect()->back()
                            ->withInput($request->all())
                            ->withErrors($errors);
            exit;
        }

        $driver_id = $request->session()->get('login_driver_id');
        $user_id = $request->session()->get('login_user_id');

        $driver_data = Driver::firstOrNew(array('id' => $driver_id));
        $user_data = User::firstOrNew(array('id' => $user_id));

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

        $user_data->name = $request->input('name');
        $user_data->lastname = $request->input('lastname');
        $user_data->email = $request->input('email');
        $user_data->save();

        // if ($profile_pic != '' || $request->input('lastname') != '' || $request->input('email') != '' || $request->input('name') != '') {
        return redirect()->back()->with('success', 'Profile updated successfully');
//        } else {
//            return redirect()->back()->with('danger', 'Nothing to change in your profile');
//        }
    }

    public function store_driver_type(Request $request) {
        $messages = [
            'car_size.required' => 'Car size is required.',
            'transmission.required' => 'Transmission is required.'
        ];
        $validator = Validator::make($request->all(), [
                    'car_size' => '',
                    'transmission' => ''
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

    public function user_history_datatable(Request $request) {

        $response = [];
        $user_id = $request->session()->get('login_user_id');
        $user_history = current_trips::where('user_id', '=', $user_id)->where('payment_status', '=', 1)->get();

        $user_history = $user_history->toArray();
        foreach ($user_history as $user) {
            $sub = [];
            $driver_id = $user['driver_id'];

            $driver_data = Driver::find($driver_id);

            $path = env('APP_URL_WITHOUT_PUBLIC');
            $driver_pic = '<img src="' . $path . 'public/bootstrap_startup/images/contact-icon.png" class="rounded-circle" width="60"/>';
            if ($driver_data->profile_pic != '') {
                $driver_pic = '<img src="' . $path . '/storage/app/' . $driver_data->profile_pic . '" class="rounded-circle" width="60"/>';
            }
            $travel_date = date('M d, Y, H:i a', strtotime($user['created_at']));
            $actual_trip_travel_time = $user['actual_trip_travel_time'];
            $total_amt = '$' . $user['total_trip_amount'];
            $trip_id = $user['id'];

            $sub[] = '<div class="row border_tr" data-toggle="collapse" data-target="#detail_' . $trip_id . '" onclick="return collasping(' . $trip_id . ');" >'
                    . '<div class="col-1 text-left">' . $driver_pic . '</div>'
                    . '<div class="col-8">'
                    . '<small>&nbsp;&nbsp;<b class="info_dark">' . $travel_date . '</b></small><br/>'
                    . '<small>&nbsp;&nbsp;1.41mi&nbsp;&nbsp;&nbsp;</small>'
                    . '<small><i class="circle_i fa fa-circle"></i>&nbsp;&nbsp;&nbsp;' . $actual_trip_travel_time . 'min</small>'
                    . '</div>'
                    . '<div class="col-3">'
                    . '<div class="text-right"><small><b class="info_dark"><br/>' . $total_amt . '</b></small></div>'
                    . '</div>'
                    . '<div class="col-12 mt-3 collapse" id="detail_' . $trip_id . '" >'
                    . '</div>'
                    . '</div>';

            $response[] = $sub;
        }

        $json_data = array(
            "data" => $response   // total data array
        );
        echo json_encode($json_data);
    }

    public function get_trip_details(Request $request) {
        $get_data = $request->all();

        $trip_id = $get_data['trip_id'];

        $trip_detail = current_trips::find($trip_id)->first();

        if ($trip_detail !== null) {
            $trip_detail['request_id'];
            $request_data = UserRequest::find($trip_detail['request_id'])->first();
            if ($request_data !== null) {
                $trip = array();
//                $trip['actual_trip_amount'] = $trip_detail->actual_trip_amount;
//                $trip['tip_amount'] = $trip_detail->tip_amount;
//                $trip['actual_trip_travel_time'] = $trip_detail->actual_trip_travel_time;
//                $trip['from_add'] = $request_data->from_address;
//                $trip['to_add'] = $request_data->to_address;
//                $trip['from_lat'] = $request_data->from_lat;
//                $trip['from_lng'] = $request_data->from_lng;
//                $trip['to_lat'] = $request_data->to_lat;
//                $trip['to_lng'] = $request_data->to_lng;
//                $trip['pickup_time'] = date('H:i a');
//                $trip['reach_time'] = date('H:i a', strtotime("+5 min"));
//
//                $trip['total_trip_amount'] = $trip_detail->total_trip_amount;

                $actual_trip_amount = $trip_detail->actual_trip_amount;
                $tip_amount = $trip_detail->tip_amount;
                $actual_trip_travel_time = $trip_detail->actual_trip_travel_time;
                $from_add = $request_data->from_address;
                $to_add = $request_data->to_address;
                $from_lat = $request_data->from_lat;
                $from_lng = $request_data->from_lng;
                $to_lat = $request_data->to_lat;
                $to_lng = $request_data->to_lng;
                $pickup_time = date('H:i a');
                $reach_time = date('H:i a', strtotime("+5 min"));

                $total_trip_amount = $trip_detail->total_trip_amount;
                $path = env('APP_URL_WITHOUT_PUBLIC');
                $visa_img = $path . '/public/bootstrap_startup/images/visa.png';
                $map_img = $path . '/public/bootstrap_startup/images/map.png';

                $html = '<div class="container box_shadow_tr" id="collapse_div">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                    <center><p><br/><small><b class="info_promo btn" id="promocode">ABC123</b></small></p></center>
                    <center><p><small><b class="info_dark" id="total_price">$' . $total_trip_amount . '</b></small></p></center>                        
                    <p><small><b class="info_dark text-left" style="font-size: 0.8em;">Thank you for requesting the Greego driver</b></small><br/></p>
                    <table class="display responsive nowrap" id="table_detail" style="width:100%">
                        <tbody class="shadow_body">
                            <tr>
                                <td><b class="start_t">S</b>tart</td>
                                <td><small class="time_t" id="start_time">' . $pickup_time . '</small><br/>
                                    <address><small class="text-dark" id="from_add">' . $from_add . '</small></address>
                                </td>
                            </tr>
                            <tr>
                                <td><b class="end_t">E</b>nd</td>
                                <td><small class="time_t" id="end_time">' . $reach_time . '</small><br/>
                                    <address><small class="text-dark" id="to_add">' . $to_add . '</small></address>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="display responsive nowrap" id="table_paydetail" style="width:100%">
                        <tbody>
                            <tr>
                                <td id="greego_miles_time">Greego fare (1.41mi, 6m 49s) </td>
                                <td id="greego_fare">$' . $actual_trip_amount . '</td>
                            </tr>                                
                            <tr>
                                <td>Promotion</td>
                                <td id="promotion_price">$' . $tip_amount . '</td>
                            </tr>
                            <tr style="border-top: solid 1px grey;">
                                <td>Total<br/>
                                    <img src="' . $visa_img . '" width="25" class="img-responsive" /></td>
                                <td id="total_fare">$' . $total_trip_amount . '</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12"><br/><br/>
                    <img id="image_map" src="' . $map_img . '" class="img-responsive"/>
                    <br/><br/>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
</div>';
                // echo json_encode($trip);
                echo $html;
            }
        } else {
            echo '0';
        }
    }

    public function ride_history($year, Request $request) {
        $id = $request->session()->get('login_driver_id');

        $viewdata['profile'] = array();
        if ($id != '') {
            $viewdata['profile'] = Driver::find($id);
            $viewdata['profile_pic'] = $viewdata['profile']->profile_pic ? env('APP_URL_WITHOUT_PUBLIC') . "/storage/app/" . $viewdata['profile']->profile_pic : "";
        }

        $viewdata['active_menu'] = 'driving_history';
        $viewdata['year'] = $year;
        return view('web_dashboard/ride_history', $viewdata);
    }

    public function driver_history_datatable(Request $request) {
        $get_year = $request->all();

        $year = $get_year['year'];
        $response = [];
        $driver_id = $request->session()->get('login_driver_id');
        $ride_history = current_trips::where('driver_id', '=', $driver_id)
                ->where('payment_status', '=', 1)
                ->whereYear('created_at', '=', $year)
                ->get();

        $ride_history = $ride_history->toArray();
        foreach ($ride_history as $ride) {
            $sub = [];
            $driver_id = $ride['user_id'];

            $driver_data = Driver::find($driver_id);

            $path = env('APP_URL_WITHOUT_PUBLIC');
            $driver_pic = '<img src="' . $path . 'public/bootstrap_startup/images/contact-icon.png" class="rounded-circle" width="60"/>';
            if ($driver_data->profile_pic != '') {
                $driver_pic = '<img src="' . $path . '/storage/app/' . $driver_data->profile_pic . '" class="rounded-circle" width="60"/>';
            }
            $travel_date = date('M d, Y, H:i a', strtotime($ride['created_at']));
            $actual_trip_travel_time = $ride['actual_trip_travel_time'];
            $total_amt = '$' . $ride['total_trip_amount'];
            $trip_id = $ride['id'];

            $sub[] = '<div class="row border_tr" data-toggle="collapse" data-target="#detail_' . $trip_id . '" onclick="return collasping(' . $trip_id . ');" >'
                    . '<div class="col-1 text-left">' . $driver_pic . '</div>'
                    . '<div class="col-8">'
                    . '<small>&nbsp;&nbsp;<b class="info_dark">' . $travel_date . '</b></small><br/>'
                    . '<small>&nbsp;&nbsp;1.41mi&nbsp;&nbsp;&nbsp;</small>'
                    . '<small><i class="circle_i fa fa-circle"></i>&nbsp;&nbsp;&nbsp;' . $actual_trip_travel_time . 'min</small>'
                    . '</div>'
                    . '<div class="col-3">'
                    . '<div class="text-right"><small><b class="info_dark"><br/>' . $total_amt . '</b></small></div>'
                    . '</div>'
                    . '<div class="col-12 mt-3 collapse" id="detail_' . $trip_id . '" >'
                    . '</div>'
                    . '</div>';

            $response[] = $sub;
        }

        $json_data = array(
            "data" => $response   // total data array
        );
        echo json_encode($json_data);
    }

}
