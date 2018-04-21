@extends('layouts.web.main')

@section('content')
<section class="text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="bg-grey1 col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <a href="{{ route('home') }}"><img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid mt-5" width="300" height="200"/></a>
                <h3 class="mt-5 pt-5 mb-5 text-center">Verify your phone number</h3>
                <form class="mt-5" method="post" action="{{ route('driver.verify_phone', $id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group row pt-3 pb-2 m-auto col-md-11">
                        <input type="hidden" value="{{ $id }}" name="id"/>
                        <input type="text" class="form-control height-input" id="otp" name="otp" value="{{ $verify_otp }}" placeholder="Enter code" />
                        <small class="text-danger">{{ $errors->first('otp') }}</small><small class="text-danger">{{ $errors->first('not_valid') }}</small>
                    </div>
                    <div class="form-group row pt-3 pb-2 m-auto col-md-11">
                        <label class="text-left text-white">Enter the code sent to +1 (703) 884-8884</label>

                    </div>
                    <a href="{{ route('driver.show',$id )}}" class="text-white row pt-3 pb-5 m-auto col-md-11">
                        <h5>Resend code</h5>
                    </a>
                    <div class="form-group row pt-3 pb-2 m-auto col-md-11">
                        <input type="submit" name="submit" class="btn btn-primary btn-greego" value="Next"/>
                    </div>
                </form>

            </div>
              <div class="cover_bg col-md-8 col-lg-8 col-sm-8 d-none d-sm-block">
                
            </div>
        </div>
    </div>
</section>
@endsection

