@extends('layouts.web.main')

@section('content')
<section class="text-center">
    <div class="container-fluid">
        <div class="row">
            <div class="bg-grey1 col-md-4 col-lg-4 col-sm-4 col-xs-12">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('bootstrap_startup/images/logo.png') }}" class="img-responsive img-fluid mt-5 mb-5" width="450"/>    
                </a>
                <h3 class="mt-3 pt-3 text-center">Enjoy the luxury service</h3>
                <div class="form-group mt-5 row pt-5 pb-2 m-auto col-md-11">
                    <h5 class="text-left text-white" style="font-size: 1.1rem;">Greego sent the link to {{ $contact_number }}</h5>
                    <h5 class="text-left text-white" style="font-size: 1.1rem;">please download Greego app and sign up!</h5>
                </div>
                <div class="form-group row pt-3 pb-5 m-auto col-md-11">
                    <h5 class="text-left text-white"><b>It won't take it long!!</b></h5>
                </div>
                <div class="form-group row m-auto col-md-11">
                    <a href="{{ route('home')}}" class=" mt-5 btn btn-primary btn-greego">
                        Back to home
                    </a>
                </div>

            </div>
            <div class="cover_bg col-md-8 col-lg-8 col-sm-8 d-none d-sm-block">

            </div>
        </div>
    </div>
</section>
@endsection
