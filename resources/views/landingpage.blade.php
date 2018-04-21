<!--<html lang="en">
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
            <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase" href="{{ route('home') }}">
                        <img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid" width="250"/>
                    </a>
                    <button class="navbar-toggler navbar-toggler-social" type="button" data-toggle="collapse" data-target="#navbar-4" aria-controls="navbar-4" aria-expanded="false" aria-label="Toggle navigation">Menu</button>
                    <div class="collapse navbar-collapse pull-xs-right justify-content-end" id="navbar-4">
                        <ul class="social navbar-nav mt-2 mt-md-0 pr-2">
                            <li><a href="{{ route('login') }}" style="">Login</a></li>
                            <li><a href="#" class="m-auto text-uppercase">&nbsp;&nbsp;&nbsp;&nbsp;help</a></li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                </div>
            </nav>
            <div class="cover-container">
                <div class="container mt-5">
                    <div class="row">
                        <div class="offset-md-1 col-md-10 offset-lg-1 col-lg-10 pt-2 pb-2 bg-white">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="transparent-select float-left">
                                            <option value="ride">RIDE</option>
                                        </select>                            
                                        <select class="transparent-select float-left ">
                                            <option value="ride">DRIVE</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('bootstrap_startup/images/google.png') }}" class="float-right img-responsive"/>
                                    <img src="{{ asset('bootstrap_startup/images/apple.png') }}" class="float-right mr-4 img-responsive"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row pt-5 mt-5">
                        <div class="offset-md-7 col-md-5 text-left login_box pt-5 pr-5 pl-5 pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-uppercase">Turn miles <br/>into money.</h2>                                    
                                    <p><small class="text-white text-uppercase" id="txt">Sign up to become a driver with greego</small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">                                          
                                    <form method="POST" class="mb-0" action="{{ route('driver.store') }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="full_number" id="full_number"/>
                                                    <input type="text" min="0" class="form-control transparent_input" id="phone" value="{{ old('contact_number') }}" name="contact_number" placeholder="phone number"/>                                                    
                                                    <small id="phone_error" class="text-danger">{{ $errors->first('contact_number') }}</small>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('name') }}" name="name" placeholder="first name"/>
                                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('lastname') }}" name="lastname" placeholder="last name"/>
                                                    <small class="text-danger">{{ $errors->first('lastname') }}</small>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('email') }}" name="email" placeholder="email"/>
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                </div>
                                            </div>                                                     
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control transparent_input"  value="{{ old('city') }}" name="city" placeholder="city"/>
                                                    <small class="text-danger">{{ $errors->first('city') }}</small>
                                                </div>
                                            </div>                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" style="border: none !important;" class="form-control transparent_input"  value="{{ old('promocode') }}" name="promocode" placeholder="promo code?"/>
                                                    <small class="text-danger">{{ $errors->first('promocode') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mt-3">                                                    
                                                    <input type="submit" class="btn btn-primary grey-btn" style="text-transform: unset;" id="become_driver" name="become_driver" value="Become a Driver" />&nbsp;&nbsp;
                                                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-transparent">Sign Up to Ride</a>                                                   
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="#" class="small-font text-white">Already applied? &nbsp;&nbsp;<span class="text-white" style="text-decoration: underline;">Check the status of your application here</span></a>
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
         Placed at the end of the document so the pages load faster 
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ URL:: asset('bootstrap_startup/bootstrap/js/bootstrap.min.js') }}"></script>
         Load jQuery from CDN so can run demo immediately 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('intl-tel-input-master/build/js/intlTelInput.js') }}"></script>
        <script>
$("#phone").intlTelInput({
    preferredCountries: [''],
    onlyCountries:['us','in'],
    separateDialCode: true,
    utilsScript: "{{ asset('intl-tel-input-master/build/js/utils.js') }}"
});
$("#phone").on('change', function () {
    $('#phone_error').html('');
    $('#become_driver').prop('disabled', false);
    var error = $("#phone").intlTelInput("getValidationError");
    var ntlNumber = $("#phone").intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
    var countryData = $("#phone").intlTelInput("getSelectedCountryData");
    if (error == intlTelInputUtils.validationError.TOO_SHORT) {
        $('#phone_error').html('Phone number is too short');
        $('#become_driver').prop('disabled', true);
    } else {
        $('#full_number').val(ntlNumber);
        $('#become_driver').prop('disabled', false);
    }
    if (error == intlTelInputUtils.validationError.TOO_LONG) {
        $('#phone_error').html('Phone number is too long');
        $('#become_driver').prop('disabled', true);
    } else {
        $('#full_number').val(ntlNumber);
        $('#become_driver').prop('disabled', false);
    }
    if (error == intlTelInputUtils.validationError.NOT_A_NUMBER) {
        $('#phone_error').html('The phone number must be a number');
        $('#become_driver').prop('disabled', true);
    } else {
        $('#full_number').val(ntlNumber);
        $('#become_driver').prop('disabled', false);
    }
});
        </script>
    </body>
</html>-->