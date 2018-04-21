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
        <link rel="stylesheet" href="{{ asset('intl-tel-input-master/build/css/intlTelInput.css') }} ">
    </head>
    <body>
        <section class="cover_home text-center">
            <nav class="navbar navbar-expand-lg d-none d-sm-block navbar-dark navbar-custom">
                <div class="container-fluid">
                    <div class="col-2">
                        <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                            <img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid" width="250"/>
                        </a>
                        <!--<button class="navbar-toggler navbar-toggler-social" type="button" data-toggle="collapse" data-target="#navbar-4" aria-controls="navbar-4" aria-expanded="false" aria-label="Toggle navigation">Menu</button>-->
                    </div>
                    <div class="col-8">

                    </div>
                    <div class="col-2">
                        <div class="collapse navbar-collapse pull-xs-right justify-content-end" id="navbar-4">
                            <ul class="social navbar-nav mt-2 mt-md-0 pr-2">
                                <li><a href="{{ route('login') }}" style="">Login</a></li>
                                <li><a href="#" class="m-auto text-uppercase help_txt">&nbsp;&nbsp;&nbsp;&nbsp;help</a></li>
                            </ul>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                </div>
            </nav>
            <!--Mobile Menu-->
            <nav class="navbar navbar-expand-lg d-md-none d-sm-none d-lg-none navbar-dark navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                        <img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid" width="250"/>
                    </a>
                    <button class="navbar-toggler navbar-toggler-social" type="button" data-toggle="collapse" data-target="#navbar-2" aria-controls="navbar-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>                        
                    </button>
                    <div class="collapse navbar-collapse pull-xs-right float-right justify-content-end" id="navbar-2">
                        <ul class="social navbar-nav mt-2 mt-md-0 pr-2 float-right">
                            <li style="width: 100%;"><a href="{{ route('login') }}">Login</a></li>
                            <li style="width: 100%;"><a href="#" class="text-uppercase help_txt">help</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                </div>
            </nav>
            <!--Mobile Menu-->
            <div class="cover-container">
                <div class="container-fluid mt-5">
                    <div class="row">
                        <div class="offset-md-2 col-md-8 offset-lg-2 col-lg-8 offset-sm-2 col-sm-8 col-xs-12 pt-2 pb-2 bg-white">
                            <div class="row">
                                <div class="col-md-1 col-lg-1 col-3">
                                    <div class="form-group">
                                        <select class="transparent-select float-left">
                                            <option value="ride">RIDE</option>
                                        </select>         
                                    </div>
                                </div>
                                <div class="col-md-1 col-lg-1 col-3">
                                    <div class="form-group">
                                        <select class="transparent-select float-left ">
                                            <option value="ride">DRIVE</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-10 col-lg-10 col-6">
                                    <img src="{{ asset('bootstrap_startup/images/google.png') }}" class="float-right img-responsive"/>
                                    <img src="{{ asset('bootstrap_startup/images/apple.png') }}" class="float-right mr-4 img-responsive"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row pt-5 mt-5">
                        <div class="offset-md-4 col-md-8 offset-lg-7 col-lg-5 offset-sm-4 col-sm-8 col-12 text-left login_box1 pt-5 pr-5 pl-5 pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-uppercase home_title">Turn miles <br/>into money.</h2>
                                    <p><small class="text-white text-uppercase" id="txt">Sign up to become a driver with greego</small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" id="form" class="mb-0 home_signup" action="{{ route('driver.store') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!--<input type="hidden" name="full_number" id="full_number"/>-->
                                                    <input type="hidden" name="type" id="type" value="user"/>
                                                    <input type="text" class="form-control transparent_input" value="{{ old('contact_number') }}" id="phone" name="contact_number" placeholder="phone number"/>
                                                    <small class="text-danger">{{ $errors->first('contact_number') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6 driver">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('name') }}" name="name" placeholder="first name"/>
                                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6 driver">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('lastname') }}" name="lastname" placeholder="last name"/>
                                                    <small class="text-danger">{{ $errors->first('lastname') }}</small>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-12 driver">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('email') }}" name="email" placeholder="email"/>
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                </div>
                                            </div>                                                     
                                            <div class="col-md-6 driver">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('city') }}" name="city" placeholder="city"/>
                                                    <small class="text-danger">{{ $errors->first('city') }}</small>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-6 driver">
                                                <div class="form-group">
                                                    <input type="text" style="border: none !important;" class="form-control transparent_input"  value="{{ old('promocode') }}" name="promocode" placeholder="promo code?"/>
                                                    <small class="text-danger">{{ $errors->first('promocode') }}</small>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group mt-3">
                                                    <input type="button" class="btn btn-primary grey-btn" style="text-transform: unset;" id="become_driver" name="become_driver" value="Become a Driver" />
                                                    <input type="submit" class="btn btn-primary grey-btn" style="text-transform: unset;" id="become_driver_sub" name="become_driver_sub" value="Become a Driver" />&nbsp;&nbsp;
                                                    <!--<a href="{{ route('driver.index') }}" class="btn btn-primary grey-btn">Become a Driver</a>-->
                                                    
                                                    <input type="button" class="btn btn-primary btn-transparent" style="text-transform: unset;" id="become_user1" name="become_user" value="Sign Up to Ride" />&nbsp;&nbsp;
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group driverfont">													
                                                    <a href="#" class="text-white drivertext">Already applied?</a>
                                                    <a href="{{ route('login') }}"><span class="text-white drivertext">Check the status of your application here</span></a>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" in                                                                                                                            tegrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ URL:: asset('bootstrap_startup/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- Load jQuery from CDN so can run demo immediately -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="{{ asset('intl-tel-input-master/build/js/intlTelInput.js') }}"></script>-->

        <script>
$(document).ready(function () {
    $('#become_driver_sub').hide();
    $('.driver').hide();
    $('#become_driver').on('click', function () {
        $('#become_driver_sub').show();
        $('#become_driver').hide();
        $('#type').val('driver');
        $('.driver').show();
    });
    $('#become_driver_sub').on('click', function () {
        $('#type').val('driver');
        $('#become_driver_sub').hide();
        $('#become_driver').show();
        $('#form').submit();
    });
    $('#become_user1').on('click', function () {
        $('#type').val('user');
        $('#form').submit();
    });
});
        </script>

    </body>
</html>