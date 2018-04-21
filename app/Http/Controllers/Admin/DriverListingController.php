<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use App\DriverBankInfo;
class DriverListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin/allDriverListing');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driverdata = Driver::where('id', $id)->where('is_approve',1)->where('profile_status',7)->first();        
//        echo '<pre>';
//        print_r($driverdata->toArray());
//        exit;
//        $driver_bankinfo = DriverBankInfo::where('driver_id', $id)->first();
//        $viewdata['driver_bank_info'] =  $driver_bankinfo;        
//        $driverdata = $driverdata->bank_information;  
        $viewdata['driverdatas'] =  $driverdata;                      
       return view('admin/driverProfileDetails',$viewdata);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function driverarray(Request $request){
        $response = [];
//        $drivers = Driver::select('id','name','email','lastname', 'contact_number','verified','created_at')->where('is_approve',1)->where('profile_status',7)->get();        
//        $drivers = $drivers->toArray();
                
        if ($request->driverdates) {
            $driverdatesarray = explode("-", $request->driverdates);
            $drivers = Driver::select('id', 'name', 'email', 'lastname', 'contact_number', 'is_approve','created_at','profile_status')
                    ->whereBetween('created_at', [$driverdatesarray[0], $driverdatesarray[1]])
                    ->where('is_approve',1)
                    ->where('profile_status',7)->get();            
        }else {
            $drivers = Driver::select('id', 'name', 'email', 'lastname', 'contact_number', 'is_approve','profile_status','created_at')
                    ->where('is_approve',1)
                    ->where('profile_status',7)
                    ->get();
        }
        $drivers = $drivers->toArray();
//        echo '<pre>';
//        print_r($drivers);
//        exit
        foreach ($drivers as $driver) {
            $sub = [];
            $sub[] = $driver['contact_number'];
            $sub[] = ($driver['name']) ? $driver['name'] : "-";
            $sub[] = ($driver['lastname']) ?  $driver['lastname'] : '-';
            $sub[] = ($driver['email']) ?  $driver['email'] : '-';            
//            if($driver['is_approve'] == 0){
//                $driver['is_approve'] = 'Pending';
//            }elseif($driver['is_approve'] == 1){
//                $driver['is_approve'] = 'Approved';
//            }else if($driver['is_approve'] == 2){
//                $driver['is_approve'] = 'Rejected';
//            }
//            $sub[] = $driver['is_approve'];
//            $creatded_on = date("m/d/Y", strtotime($driver['created_at']));
            $sub[] = ($driver['created_at']) ? $driver['created_at'] : "-";;
            $id = $driver['id'];
            $sub[] = "<a href='". route('admin.driver.show', $id ) ."'><i class='fa fa-bars' aria-hidden='true'></i></a>";
            $response[] = $sub;
        }
        $driverjson = json_encode(["data" => $response ]);
        echo $driverjson;
    }
    /* function to approve reject driver */
    public function updateStatus(Request $request) {
        $id = $request->id;        
        $state =  substr($id,0,2);
        if($state == 'a_'){
            $state = 1;
        }else{
            $state = 2;
        }
        
        $id = substr($id, strpos($id, "_") + 1);
        $driver = Driver::find($id);
        
        if($driver){
            $driver->is_approve = $state;
            $driver->save();
            $driver_status = Driver::where('id',$id)->first();
            echo $driver_status->is_approve;            
        }else{
            echo 'fail';
        }        
    }
}
