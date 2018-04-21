@extends('layouts.web.main')

@section('content')
<section class="text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="bg-grey1 col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid mt-5" width="450"/>    
                </a>
                <h3 class="mt-3 pt-5 mb-5 text-center">Enjoy the luxury service</h3>
                <form class="mt-5" method="post" action="{{ route('login.auth') }}">
                    {{ csrf_field() }}                     
                    {{ method_field('POST') }}
                    <div class="form-group row pt-3 pb-2 m-auto col-md-11 black_intl">
                        <!--<input type="hidden" name="full_number" id="full_number"/>-->
                        <input type="text" class="form-control height-input" name="contact_number" value="{{ old('contact_number') }}" id="phone" placeholder="Enter phone number"/>
                        <small id="phone_error" class="text-danger">{{ $errors->first('contact_number') }}</small>
                    </div>
                    <div class="mb-5 form-group">
                        <label class='sendlogin'>We'll send a text to verify your phone</label>
                    </div>
                    <div class="form-group row pt-3 pb-2 m-auto col-md-11 nextbtn">
                        <input type="submit" id="next" name="submit" class="btn btn-primary btn-greego" value="Next"/>
                    </div>
                </form>

            </div>
            <div class="cover_bg col-md-8 col-lg-8 col-sm-8 d-none d-sm-block">
                
            </div>
        </div>
    </div>
</section>
@endsection

