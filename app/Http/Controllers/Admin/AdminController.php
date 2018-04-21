<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Model;
use App\Model\Adminlogin;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Driver;
class AdminController extends Controller {
   
    public function index(Request $request) {
        if ($request->session()->has('admin_email')) {
//            return $next($request);
            $userdata = $request->all();
            $driver_count = Driver::all()->count();            
            $user_count = User::all()->count();
            $android_user = User::where('is_iphone',0)->count();            
            $iphone_user = User::where('is_iphone',1)->count();            
            return view('admin/dashboard',array('driver_count' =>$driver_count,'user_count' => $user_count,'android_user' => $android_user,'iphone_user' => $iphone_user  ));
        }else{
            return view('admin/loginNew');
        }       
    }
    
    public function store(Request $request) {
        $admin_count = Adminlogin::where('email', $request->admin_email)->where('password', $request->admin_password)->count();
        if ($admin_count > 0) {
            $data = Adminlogin::where('email', $request->admin_email)->where('password', $request->admin_password)->get();            
            $data = $data->toArray();
            $userdata = $request->all();           
            Session::put('admin_email', $userdata['admin_email']);
            return redirect('admin');
        } else {
            return redirect()->back()->with('error', 'User name or password is invalid')->withInput($request->all());
        }        
    }
    
    public function logout(){
        Session::flush();
//        return Redirect::to('/admin');
        return redirect('admin');
//        return view('admin/login');
    }
    public function dashboard(){               
        return view('admin/dashboard');
    }
}
