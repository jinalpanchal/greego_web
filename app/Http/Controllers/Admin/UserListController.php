<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserVehicle;
use App\UserCard;
use DB;
class UserListController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {                  
        return view('admin/allUserListing');
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //echo $id;
        $userdata = User::find($id);
//        echo '<pre>';
//        print_r($userdata);
//        exit;
        $usercards = UserCard::where('user_id', $userdata->id)->get();       
        $vehicles = UserVehicle::where('user_id', $userdata->id)->get();
        $viewdata['userdatas'] =  $userdata;
        $viewdata['usercards'] =  $usercards;
        $viewdata['vehicles'] =  $vehicles;         
        return view('admin/userProfileDetails',$viewdata);
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

    public function userarray(Request $request) {
        $response = [];
        
        $users = User::select('id','name','email','lastname', 'contact_number','verified','is_deactivated')->get();
        $users = $users->toArray();        

        if ($request->userdates) {
            $userdatesarray = explode("-", $request->userdates);
            $users = User::select('id', 'name', 'email', 'lastname', 'contact_number', 'verified','is_deactivated','created_at')
                    ->whereBetween('created_at', [$userdatesarray[0], $userdatesarray[1]])
                    ->get();
        } else {
            $users = User::select('id', 'name', 'email', 'lastname', 'contact_number', 'verified','is_deactivated','created_at')->get();
        }
        $users = $users->toArray();

        foreach ($users as $user) {
            $sub = [];
            $sub[] = $user['contact_number'];
            $sub[] = ($user['name']) ? $user['name'] : "-";
            $sub[] = ($user['lastname']) ? $user['lastname'] : "-";
            $sub[] = ($user['email']) ? $user['email'] : "-";
            if($user['verified'] == 0){
                $user['verified'] = 'No';
            }else{
                $user['verified'] = 'Yes';
            }
            $sub[] = $user['verified'];
            
//            $creatded_on = date("m/d/Y", strtotime($user['created_at']));
            $sub[] = ($user['created_at']) ? $user['created_at'] : "-";;
            $id = $user['id'];
            /*
            if($user['is_deactivated'] == 0){
                $sub[] ="<ul class='admin-action btn btn-default'><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Action <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='". route('admin.newdriver.ajax.newDriverChangeStatus', array('id'=> $id,'status'=>1) ) ."'>Deactivate</a></li></ul></li></ul>";
            }else{
                //disable user view for 1
                $sub[] ="<ul class='admin-action btn btn-default'><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Action <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='". route('admin.newdriver.ajax.newDriverChangeStatus', array('id'=> $id,'status'=>0) ) ."'>Activate</a></li><li><a href='". route('admin.user.show', $id ) ."'>View Profile</a></li></ul></li></ul>";
            }
            */
            $sub[] = "<a href='". route('admin.user.show', $id ) ."'><i class='fa fa-bars' aria-hidden='true'></i></a>";
            $sub[] = 
            $response[] = $sub;
        }
        $userjson = json_encode(["data" => $response]);
        echo $userjson;
    }
    
    public function userDisableStatus(Request $request) {
        
    }
}
