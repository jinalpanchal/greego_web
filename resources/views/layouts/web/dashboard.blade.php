<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Greego</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="{{ asset('bootstrap_startup/bootstrap/css/bootstrap.css') }}">
        <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
        <link rel="stylesheet" href="{{ asset('bootstrap_startup/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap_startup/css/custom.css') }}">

        <link rel="stylesheet" href="{{ asset('bootstrap_startup/bootstrap/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('intl-tel-input-master/build/css/intlTelInput.css') }} ">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

        <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    </head>
    <body class="bg-grey">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            @if(Session::has('login_driver_id') || Session::has('login_user_id'))
            <a class="navbar-brand" href="{{ url('account/dashboard/') }}"> 
                <img src="{{ asset('bootstrap_startup/images/logo_main.png') }}" class="img-responsive img-fluid" width="200" height="100"/>
            </a>
            @else
            <a class="navbar-brand" href="{{ route('home') }}"> 
                <img src="{{ asset('bootstrap_startup/images/logo_main.png') }}" class="img-responsive img-fluid" width="200" height="100"/>
            </a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-capitalize" href="#">Help <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <div class="inset">
                        {{ $profile->name .' ' .$profile->lastname }} &nbsp;&nbsp;

                        @if($profile->profile_pic != '')
                        <img src="{{ $profile_pic }}" width="60" class="rounded-circle">
                        @else
                        <img src="{{ asset('bootstrap_startup/images/contact-icon.png') }}" width="60" class="rounded-circle">
                        @endif

                    </div>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row mt-3 mb-3 p-auto">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col-md-3 p-3">
                            <ul class="list-unstyled left-menu">
                                @if( session('login_driver_id') )

                                <button class="btn btn-primary menu-btn full-width border-radius">Driver</button>
                                <li class="mt-3">                                
                                    <a href="{{ url('account/dashboard/') }}" @if($active_menu == 'dashboard') class="active" @endif >@if($active_menu == 'dashboard') <i class="fa fa-circle"></i>@endif Dashboard</a>
                                </li>

                                <li>
                                    <a href="{{ url('account/driving_history/') }}" @if($active_menu == 'driving_history') class="active" @endif >@if($active_menu == 'driving_history')<i class="fa fa-circle"></i>@endif Driving History</a>
                                </li>

                                <li>
                                    <a href="{{ url('account/documents/') }}" @if($active_menu == 'documents') class="active" @endif >@if($active_menu == 'documents') <i class="fa fa-circle"></i>@endif Documents</a>
                                </li>

                                <li>
                                    <a href="{{ url('account/payment/') }}" @if($active_menu == 'payment') class="active" @endif >@if($active_menu == 'payment') <i class="fa fa-circle"></i>@endif Payment</a>
                                </li>

                                <li>
                                    <a href="{{ url('account/reward/') }}" @if($active_menu == 'reward') class="active" @endif >@if($active_menu == 'reward') <i class="fa fa-circle"></i>@endif Reward</a>
                                </li>

                                <li>
                                    <a href="{{ url('account/setting/') }}" @if($active_menu == 'setting') class="active" @endif > @if($active_menu == 'setting') <i class="fa fa-circle"></i> @endif Setting</a>
                                </li>

                                @endif

                                @if( session('login_user_id') )
                                <button class="btn btn-primary menu-btn full-width border-radius">User</button>
                                <li class="mt-3">                                
                                    <a href="{{ url('account/user_history/') }}" @if($active_menu == 'user_history') class="active" @endif >@if($active_menu == 'user_history') <i class="fa fa-circle"></i>@endif History</a>
                                </li>                                
                                @endif

                                <li>
                                    <a href="{{ url('logout') }}">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 full-height">

                            @if( session('success') )
                            <div class="alert alert-success alert-dismissable mt-5">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>Success ! </b>{{ session('success') }}
                            </div>
                            @endif

                            @if( session('danger') )
                            <div class="alert alert-danger alert-dismissable mt-5">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>Failed ! </b>{{ session('danger') }}
                            </div>
                            @endif

                            @yield('content')

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left">
                        <p>Copyright &copy; GREEGO. All rights reserved.</p>
                    </div>
                    <!--                            <div class="col-md-6 text-center text-md-right mb-4">
                                                    <ul class="social">
                                                        <li><a href="#" title="Facebook"><em class="fab fa-facebook-f"></em></a></li>
                                                        <li><a href="#" title="Twitter"><em class="fab fa-twitter"></em></a></li>
                                                        <li><a href="#" title="Google+"><em class="fab fa-google-plus-g"></em></a></li>
                                                        <li><a href="#" title="Dribbble"><em class="fab fa-dribbble"></em></a></li>
                                                        <li><a href="#" title="Instagram"><em class="fab fa-instagram"></em></a></li>
                                                        <div class="clear"></div>
                                                    </ul>
                                                </div>-->
                </div>
            </div>
        </footer>

        <!-- Placed at the end of the document so the pages load faster -->
        <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ URL:: asset('bootstrap_startup/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- iCheck 1.0.1 -->
        <script src="{{ URL:: asset('plugins/iCheck/icheck.min.js') }}"></script>
        <!-- InputMask -->
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

        <script>
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
});

        </script>
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>

        @yield('js')

    </body>
</html>
