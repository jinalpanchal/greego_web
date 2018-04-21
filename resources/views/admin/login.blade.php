@extends('layouts.admin_login')
@section('content')
    <div class="login-logo adminLogo">
        <img src="bootstrap_startup/images/logo_main.png" class="img-responsive img-fluid" width="300">
  </div>
  <!-- /.login-logo -->
  <!-- Error message -->
    @if( session('error') )
        <div class="alert alert-danger alert-dismissable fade in alert_msg">            
            <span style='color:red'>{{ session('error') }}</span>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
    @endif
    <!-- end of error message-->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form class="login-form" method='post' action="{{ route('admin.store')}}">
        {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" name='admin_email' class="form-control" id='username' placeholder="Username" value='{{ old('admin_email') }}' required/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name='admin_password' class="form-control" id='password' placeholder="Password" required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
<!--        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>-->
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->
<!--    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->
  </div>
  <!-- /.login-box-body -->
@endsection