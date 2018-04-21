<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use App\DriverBankInfo;
class NewDriverApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('admin/newDriverApplicationList');        
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Request $request)
    {
        
    }
    
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

   public function newdriverarray(Request $request){
        $response = [];
//        $drivers = Driver::select('id','name','email','lastname', 'contact_number','verified','created_at','profile_status')
//                ->where('profile_status',7)
//                ->get();
//        $drivers = $drivers->toArray();
                
        if ($request->driverdates) {
            $driverdatesarray = explode("-", $request->driverdates);
            $drivers = Driver::select('id', 'name', 'email', 'lastname', 'contact_number', 'is_approve','created_at')
                    ->whereBetween('created_at', [$driverdatesarray[0], $driverdatesarray[1]])
                    ->where('profile_status',7)
                    ->get();
        }else {
            $drivers = Driver::select('id', 'name', 'email', 'lastname', 'contact_number', 'is_approve','created_at')
                    ->where('profile_status',7)
                    ->get();
        }
        $drivers = $drivers->toArray();
        
        foreach ($drivers as $driver) {
            $sub = [];
            $sub[] = $driver['contact_number'];
            $sub[] = ($driver['name']) ? $driver['name'] : "-";
            $sub[] = ($driver['lastname']) ?  $driver['lastname'] : '-';
            $sub[] = ($driver['email']) ?  $driver['email'] : '-';            
            if($driver['is_approve'] == 0){
                $driver['is_approve'] = '<span class="label label-warning">Pending</span>';
            }elseif($driver['is_approve'] == 1){
                $driver['is_approve'] = '<span class="label label-success">Approved</span>';
            }else if($driver['is_approve'] == 2){
                $driver['is_approve'] = '<span style="background-color:#dd4b39 !important;" class="label label-danger">Rejected</span>';
            }
            $sub[] = $driver['is_approve'];
//            $creatded_on = date("m/d/Y", strtotime($driver['created_at']));
            $sub[] = ($driver['created_at']) ? $driver['created_at'] : "-";;
            $id = $driver['id'];            
            $sub[] ="<ul class='admin-action btn btn-default'><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Action <span class='caret'></span></a><ul class='dropdown-menu'><li><a href='". route('admin.newdriver.ajax.newDriverChangeStatus', array('id'=> $id,'status'=>1) ) ."'>Approve</a></li><li><a href='". route('admin.newdriver.ajax.newDriverChangeStatus',array('id'=> $id,'status'=>2) ) ."'>Reject</a></li></ul></li></ul>";
            $response[] = $sub;
        }
        $driverjson = json_encode(["data" => $response ]);
        echo $driverjson;
    }
   public function newDriverChangeStatus(Request $request) {      
//       $data = $request->all();
//       echo 'id: '.$request->id;
//       echo '<br>status: '.$request->status;
//       exit;
       $newdriver = Driver::find($request->id);
       $newdriver->is_approve = $request->status;
        
        if($newdriver->save()){
            return view('admin/newDriverApplicationList');
        }else{
            echo "Status updatation error.";
        }
       
   }
}
