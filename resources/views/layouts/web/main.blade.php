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
        <link rel="stylesheet" href="{{ asset('intl-tel-input-master/build/css/intlTelInput.css') }} ">
    </head>
    <body>

        @yield('content')

        <!--        <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-left">
                                <p>Copyright &copy; YourStartup. All rights reserved.</p>
                            </div>
                            <div class="col-md-6 text-center text-md-right mb-4">
                                <ul class="social">
                                    <li><a href="#" title="Facebook"><em class="fab fa-facebook-f"></em></a></li>
                                    <li><a href="#" title="Twitter"><em class="fab fa-twitter"></em></a></li>
                                    <li><a href="#" title="Google+"><em class="fab fa-google-plus-g"></em></a></li>
                                    <li><a href="#" title="Dribbble"><em class="fab fa-dribbble"></em></a></li>
                                    <li><a href="#" title="Instagram"><em class="fab fa-instagram"></em></a></li>
                                    <div class="clear"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>-->

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="{{ URL:: asset('bootstrap_startup/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- InputMask -->
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
        <script src="{{ URL:: asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

        <script>
$("#otp").inputmask({"mask": "999999"});
        </script>
        @yield('js')

    </body>
</html>
