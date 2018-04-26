@extends('layouts.web.dashboard')

@section('content')
<form action="{{ route('account.store_profile_data') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row p-4 mt-2">
        <div class="col-md-1">
            @if($profile->profile_pic != '')
            <img src="{{ $profile_pic }}" width="80" class="rounded-circle">
            @else
            <img src="{{ asset('bootstrap_startup/images/contact-icon.png') }}" width="80" class="rounded-circle">
            @endif
        </div>
        <div class="col-md-8">
            <center><h3 class="header-height">Profile Photo</h3></center>
        </div>
    </div>
    <div class="row p-4 mt-2">
        <div class="col-md-12">
            <div class="form-group no-border">
                <label>First Name</label>
                <input class="form-control" type="text" name="name" value="{{ $profile->name == '' ? '': $profile->name }}"/>
                <small class="text-danger">{{ $errors->first('lastname') }}</small>
            </div>
            <div class="form-group no-border">
                <label>Last Name</label>
                <input class="form-control" type="text" name="lastname" value="{{ $profile->lastname == '' ? '' : $profile->lastname }}"/>
                <small class="text-danger">{{ $errors->first('lastname') }}</small>
            </div>
            <div class="clearfix"></div>
            <div class="form-group no-border">
                <div class="input-group-prepend">
                    <span class="input-group-text input-group-addon-trans"><i class="far fa-envelope"></i></span>

                    <input class="form-control" type="text" name="email" value="{{ $profile->email == '' ? '': $profile->email }}"/>
                </div>
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="offset-md-3 col-md-4 mt-3">
                <div class="form-group shadow-btn">
                    <center><input type="submit" class="btn btn-transparent text-dark text-center" type="text" name="update" value="Update"/></center>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row pt-3 pl-5 pr-5 pb-5 light_gray">
    <form id="myForm" class="col-md-12" action="{{ route('account.store_driver_type') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12 mb-3">
            <p class="text-dark weight_700">Select types that you can drive</p>
            <h6 class="text-dark">Car-Size</h6>
            <div class="form-group">
                <label>   
                    <!--<input class="flat-red" name="is_sedan" {{ $profile->is_sedan == 1 ? "checked"  : "" }} onchange="return driver_type(this.name);" type="checkbox" value="1">-->
                    <input class="flat-red"  name="car_size[is_sedan]" {{ $profile->is_sedan == 1 ? "checked"  : "" }} type="checkbox" value="1">
                    Sedan
                </label><br/>
                <label>   
                    <input class="flat-red"  name="car_size[is_suv]"  {{ $profile->is_suv == 1 ? "checked"  : "" }} type="checkbox" value="1">
                    SUV
                </label><br/>
                <label>   
                    <input class="flat-red" name="car_size[is_van]" {{ $profile->is_van == 1 ? "checked"  : "" }}  type="checkbox" value="1">
                    VAN
                </label><br/>
            </div>
            <small class="text-danger">{{ $errors->first('car_size') }}</small>
        </div>
        <div class="col-md-12 mb-5">
            <h6 class="text-dark">Transmission</h6>
            <div class="form-group">
                <label>   
                    <input class="flat-red"  name="transmission[is_auto]" {{ $profile->is_auto == 1 ? "checked"  : "" }}  type="checkbox" value="1">
                    Auto
                </label><br/>
                <label>   
                    <input class="flat-red"  name="transmission[is_manual]"  {{ $profile->is_manual == 1 ? "checked"  : "" }} type="checkbox" value="1">
                    Manual
                </label>
            </div>
            <small class="text-danger">{{ $errors->first('transmission') }}</small>
        </div>
    </form>
</div>


@endsection

@section('js')

<script>
    var checkboxes = $("#myForm").find("input[type=checkbox]");

    checkboxes.on('ifChecked ifUnchecked', function (event) {
        $(event.target).change();
        $('#myForm').submit();
    });
</script>
@endsection
