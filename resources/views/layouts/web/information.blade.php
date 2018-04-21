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
        <link rel="stylesheet" href="{{ asset('bootstrap_startup/bootstrap/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap_startup/bootstrap/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('intl-tel-input-master/build/css/intlTelInput.css') }} ">
    </head>
    <body class="bg-grey">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}"> 
                <img src="{{ asset('bootstrap_startup/images/logo_main.png') }}" class="img-responsive img-fluid" width="200" height="100"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-capitalize" href="#">Help <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="row mt-3 mb-3 p-auto">
                @yield('content')
            </div>
        </div>


        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ URL:: asset('bootstrap_startup/bootstrap/js/bootstrap.min.js') }}"></script>
 <!-- InputMask -->
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

        @yield('js')

    </body>
</html>
