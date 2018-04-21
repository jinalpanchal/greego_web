@extends('layouts.admin_login')
@section('content')
<!--    <div class="login-logo adminLogo">
        <img src="bootstrap_startup/images/logo_main.png" class="img-responsive img-fluid" width="300">
    </div>-->
  <!-- /.login-logo -->    
    
  <div class="login_outer">
        <div class="login_outer_overlay"></div>
        <div class="col-md-offset-4 col-md-4">
<!--                <div class='row'>
                <div class='col-md-offset-4 col-sm-4'>-->
                    <!-- Error message -->
                    @if( session('error') )
                        <div class="alert alert-danger alert-dismissable fade in alert_msg">            
                            <span style='color:white'>{{ session('error') }}</span>
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                    <!-- end of error message-->
<!--                </div>        
            </div>-->
            </div>  
        <div class="inner">                                  
            <div class="login-box">
                <div class="login-box-body" style="height:auto;">
                    <form class="login-form" method='post' action="{{ route('admin.store')}}">
                    {{csrf_field()}}                       
                        <p class="text-center mb30"></p>
                        <div class="form-inputs">
                            <div class="login-logo">
                                <a href=""><b> <img class="adm-log-logo" style="width:50%;height:auto" src="bootstrap_startup/images/logo_main.png"></b></a>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control input-lg" name="admin_email" value='{{ old('admin_email') }}' placeholder="Email" value="">                    
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" name="admin_password" placeholder="Password" value="">
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn_login_new btn-block mb15" type="submit">
                                <h5><span><i class="fa fa-btn fa-sign-in"></i> Login</span></h5>
                            </button>
                        </div>
                        <div class="form-group">
                            <a style="margin-left:100px" class="btn btn-link" href="#">Reset Password</a>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div><!-- end of login outer -->
@endsection