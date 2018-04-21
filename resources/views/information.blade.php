@extends('layouts.web.information')

@section('content')
<div class="container bg-white information">
    <div class="row">
        <div class="col-md-3 p-3">

            <ul class="list-unstyled left-menu">

                <center>
                    <div class="btn menu-btn pull-left progress_div" style="">

                        @if($percentage == 100)
                        <div class="btn menu-btn pull-left progress_bar" style="width: 90%;">&nbsp;</div>
                        <span class="vertical_sub">100%</span>
                        @else
                        <div class="btn menu-btn pull-left progress_bar" style="width: {{ $percentage }}%;">&nbsp;</div>
                        <span class="vertical_sub">{{ $percentage }}%</span>
                        @endif
                    </div>
                </center>

                <li class="pt-5 mt-2"><center><a class="active"><h4 class="mt-2"><b>@if($profile->profile_status == '7') {{ $profile->profile_status }} @else {{ $profile->profile_status + 1 }} @endif / 7 Complete</b></h4></a></center></li>
                <li class="mt-3">                                
                    <a href="#" @if($profile->profile_status == '0' || $profile->profile_status >= '1' ) class="active" @endif ><i class="fa fa-circle"></i> Verify</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '1' || $profile->profile_status >= '2' ) class="active" @endif ><i class="fa fa-circle"></i> Personal Info</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '2' || $profile->profile_status >= '3' ) class="active" @endif ><i class="fa fa-circle"></i> Shipping Address</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '3' || $profile->profile_status >= '4' ) class="active" @endif ><i class="fa fa-circle"></i> Background checks</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '4' || $profile->profile_status >= '5' ) class="active" @endif ><i class="fa fa-circle"></i> Bank Info</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '5' || $profile->profile_status >= '6' ) class="active" @endif ><i class="fa fa-circle"></i> Driver Type</a>
                </li>
                <li>
                    <a href="#" @if($profile->profile_status == '6' || $profile->profile_status >= '7' ) class="active" @endif ><i class="fa fa-circle"></i> Profile</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9 p-4 full-height">
            @if( session('success') )
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <b>Success ! </b>{{ session('success') }}
            </div>
            @endif

            <div class="alert alert-danger alert-dismissable" id="error_ext" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <div id="img_ext_error"></div>
            </div>

            @if($profile->profile_status == '0')

            <div class="row" style="height: 50vh;">
                <div class="col-md-12">
                    <center>
                        <a href="{{ route('driver.show',$profile->id) }}">Click here to verify</a>            
                    </center>
                </div>
            </div>

            @endif 


            @if($profile->profile_status == '1') 
            <h3 class="green-color">Personal Information</b></h4>     
            <p class="text-dark info_p pt-5">Greego is commited to keeping our drivers and passengers safe. We run background checks to screen drivers for any criminal offenses and driver incidents.</p>
            <p class="info_p">Please enter your name exactly as it appears on your driver's license.</p>
            <form method="post" action="{{ route('driverinfo.store_personal_info')}}">
                {{ csrf_field() }}

                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Legal First Name</label>
                            <input type="text" class="form-control" value="{{ old('legal_first_name') }}" name="legal_first_name" />
                            <small class="text-danger">{{ $errors->first('legal_first_name') }}</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Middle Name(Optional)</label>
                            <input type="text" class="form-control" value="{{ old('middle_name') }}"  name="middle_name" />
                            <small class="text-danger">{{ $errors->first('middle_name') }}</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Legal Last Name</label>
                            <input type="text" class="form-control" value="{{ old('legal_last_name') }}"  name="legal_last_name" />
                            <small class="text-danger">{{ $errors->first('legal_last_name') }}</small>
                        </div>
                    </div>
                    <div class="col-md-5 mt-5">
                        <div class="form-group">
                            <label>Social Security Number</label>
                            <input type="text" class="form-control"  value="{{ old('social_security_number') }}" id="social_security_number" name="social_security_number" />
                            <small class="text-danger">{{ $errors->first('social_security_number') }}</small>
                        </div>
                    </div>
                    <div class="col-md-3 mt-5">
                        <div class="form-group">    
                            <label>Date Of Birth</label>
                            <select placeholder="MM" class="form-control" name="month">
                                <option value="">MM</option>
                                <?php
                                $monthArray = range(1, 12);
                                $today_m = date('m');
                                ?>
                                @foreach ($monthArray as $month)
                                <option value="{{ $month }}" {{ $month == $today_m ? "selected" : "" }} >{{ $month }}</option>
                                @endforeach;

                            </select>
                            <small class="text-danger">{{ $errors->first('month') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <select placeholder="DD" class="form-control" name="date">
                                <option value="">DD</option>
                                <?php
                                $dateArray = range(1, 31);
                                $today_d = date('d');
                                ?>
                                @foreach ($dateArray as $date)
                                <option value="{{ $date }}" {{ $date == $today_d ? "selected" : "" }} >{{ $date }}</option>
                                @endforeach;

                            </select>
                            <small class="text-danger">{{ $errors->first('date') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 mt-5">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <select placeholder="YYYY" class="form-control" name="year">
                                <option value="">YYYY</option>
                                <?php
                                $yearArray = range(1900, 2010);
                                ksort($yearArray);
                                ?>
                                @foreach ($yearArray as $year)
                                <option value="{{ $year }}" {{ $year == 1993 ? "selected" : "" }} >{{ $year }}</option>
                                @endforeach;
                            </select>
                            <small class="text-danger">{{ $errors->first('year') }}</small>
                        </div>
                    </div>
                    <div class="offset-md-4 col-md-4 offset-lg-4 col-lg-4 offset-sm-4 col-sm-4  mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>

            </form>
            @endif

            @if($profile->profile_status == '2') 
            <h3 class="green-color mb-5">Shipping Address</b></h4>     
            <p class="text-dark pt-2 info_p">We use your residental address to send you your car emblem and driver-related supplies and goodies.</p>

            <form method="post" action="{{ route('driverinfo.store_shipping_address')}}">
                {{ csrf_field() }}

                <div class="row mt-5 pt-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address 1</label>
                            <input type="text" class="form-control" value="{{ old('address_1') }}" name="address_1" />
                            <small class="text-danger">{{ $errors->first('address_1') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address 2</label>
                            <input type="text" class="form-control" value="{{ old('address_2') }}"  name="address_2" />
                            <small class="text-danger">{{ $errors->first('address_2') }}</small>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" value="{{ old('city') }}"  name="city" />
                            <small class="text-danger">{{ $errors->first('city') }}</small>
                        </div>
                    </div>

                    <div class="col-md-4 mt-2">
                        <div class="form-group">    
                            <label>State</label>
                            <input type="text" class="form-control" value="{{ old('state') }}" id="state" name="state" />
                            <small class="text-danger">{{ $errors->first('state') }}</small>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2">
                        <div class="form-group">
                            <label>Zipcode</label>
                            <input type="text" class="form-control"  value="{{ old('zipcode') }}" name="zipcode" />
                            <small class="text-danger">{{ $errors->first('zipcode') }}</small>
                        </div>
                    </div>

                    <div class="offset-md-4 col-md-4 offset-lg-4 col-lg-4 offset-sm-4 col-sm-4  mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>

            </form>
            @endif


            @if($profile->profile_status == '3') 
            <h3 class="green-color">Background Checks</b></h4>                 
            <p class="text-dark info_p pt-5">Greego is commited to keeping our drivers and passengers safe. We run background checks to screen drivers for any criminal offenses and driver incidents.</p>

            <form method="post" action="{{ route('driverinfo.store_driver_document') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mt-5">
                    <div class="col-md-12">

                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label class="info_p">Upload a photo of your Driver's License</label><br/>
                                <img src="{{ asset('bootstrap_startup/images/driving_license.png') }}" id="image1" class="img-responsive img-fluid" />
                            </div>
                            <div class="col-md-3 mt-5">
                                <!--                                <div class="form-group mt-4">
                                                                    <input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>
                                                                </div>-->
                                <div class="form-group mt-md-3 mt-lg-3 mt-sm-3">
                                    <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                                        Upload photo 
                                        <input type="file" onchange="readURL(this, 'image1');" name="driving_license"/>
                                    </div>
                                    <center>
                                        <small class="text-danger">{{ $errors->first('driving_license') }}</small>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label class="info_p">Upload a photo of your Auto Insurance Card</label><br/>
                                <img src="{{ asset('bootstrap_startup/images/insurance_card.png') }}" id="image2" class="img-responsive img-fluid" />
                            </div>
                            <div class="col-md-3 mt-5">
                                <!--                                <div class="form-group mt-4">
                                                                    <input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>
                                                                </div>-->
                                <div class="form-group mt-md-3 mt-lg-3 mt-sm-3">
                                    <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                                        Upload photo 
                                        <input type="file" onchange="readURL(this, 'image2');" name="insurance_card"/>
                                    </div>
                                    <center>
                                        <small class="text-danger">{{ $errors->first('insurance_card') }}</small>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <label class="info_p"><b>Options</b></label><br/>
                                <label><small><i class="help_doc_txt info_p">It helps to prove your background check faster</i></small></label>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="text-dark" onclick="return show_div('home_insurance');"><u class="text_normal green_doc info_p"><b>Do you have a home insurance?</b></u></a><br/>
                                <label class="home_insurance"><small><i>Please upload a home insurance document</i></small></label>
                                <img src="{{ asset('bootstrap_startup/images/home_insurance.png') }}"  id="image3" class="home_insurance img-responsive img-fluid" />
                            </div>
                            <div class="col-md-3 mt-5 pt-5 home_insurance">
                                <!--                                <div class="form-group">
                                                                    <input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>
                                                                </div>-->
                                <div class="form-group mt-md-3 mt-lg-3 mt-sm-3">
                                    <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                                        Upload photo 
                                        <input type="file" onchange="readURL(this, 'image3');" name="home_insurance"/>
                                    </div>
                                    <center>
                                        <small class="text-danger">{{ $errors->first('home_insurance') }}</small>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="text-dark" onclick="return show_div('current_driver');"><u class="text_normal1 green_doc info_p"><b>Are you Uber & Lyft driver?</b></u></a><br/>
                                <label class="current_driver"><small><i>Please upload a current Uber & Lyft driver payroll that's less than 10 days.</i></small></label>
                                <img src="{{ asset('bootstrap_startup/images/current_driver.png') }}"  id="image4" class="current_driver img-responsive img-fluid" />
                            </div>
                            <div class="col-md-3 mt-5 pt-5 current_driver">
                                <!--                                <div class="form-group">
                                                                    <input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>
                                                                </div>-->
                                <div class="form-group mt-md-3 mt-lg-3 mt-sm-3">
                                    <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                                        Upload photo 
                                        <input type="file" onchange="readURL(this, 'image4');" name="current_driver"/>
                                    </div>
                                    <center>
                                        <small class="text-danger">{{ $errors->first('current_driver') }}</small>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-4 col-md-4 offset-lg-4 col-lg-4 offset-sm-4 col-sm-4  mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>

            </form>
            @endif


            @if($profile->profile_status == '4') 
            <h4 class="green-color"><b>Bank Info</b></h4>            
            <p class="text-dark pt-3 info_p">This page manages your payment information and very important for you</p>
            <div class="row">
                <div class="col-12 offset-lg-4 offset-md-4 offset-sm-4 col-lg-3 col-sm-3 col-md-3">
                <img src="{{ asset('bootstrap_startup/images/bank_check.png') }}" class="img-responsive img-fluid" width="140" height="80"/>
                </div>
            </div>
            

            <form method="post" action="{{ route('driverinfo.store_bank_info')}}">
                {{ csrf_field() }}

                <div class="row mt-5">
                    <div class="col-md-11">
                        <div class="form-group">
                            <label>Accounting Number</label>
                            <input type="text" class="ml-3 form-control" value="{{ old('account_number') }}" name="account_number" />
                            <small class="text-danger">{{ $errors->first('account_number') }}</small>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label>Routing Number</label>
                            <input type="text" class="ml-3 form-control" value="{{ old('routing_number') }}"  name="routing_number" />
                            <small class="text-danger">{{ $errors->first('routing_number') }}</small>
                        </div>
                    </div>


                    <div class="offset-md-4 col-md-4 offset-lg-4 col-lg-4 offset-sm-4 col-sm-4  mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>

            </form>
            @endif

            @if($profile->profile_status == '5') 
            <h3 class="green-color">Driver Type</b></h4>     
            <p class="text-dark pt-4">This page manages your type of driving. You can choose more than one</p>
            <form method="post" action="{{ route('driverinfo.store_driver_type')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-5 m-3">
                                <h4 class="text-dark"><b>Car-Size</b></h4>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="car_size[is_sedan]"   {{ (is_array(old('car_size')) && in_array(1, old('car_size'))) ? ' checked' : '' }}   type="checkbox" value="1">
                                               Sedan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">

                                        <input class="form-check-input" name="car_size[is_suv]" {{ (is_array(old('car_size')) && in_array(1, old('car_size'))) ? ' checked' : '' }} type="checkbox" value="1">
                                               SUV
                                    </label>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="car_size[is_van]" {{ (is_array(old('car_size')) && in_array(1, old('car_size'))) ? ' checked' : '' }} type="checkbox" value="1">
                                               VAN
                                    </label>
                                </div>
                                <small class="text-danger">{{ $errors->first('car_size') }}</small>

                            </div>
                            <div class="col-md-5 m-3">
                                <h4 class="text-dark"><b>Transmission</b></h4>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="transmission[is_auto]" {{ (is_array(old('transmission')) && in_array(1, old('car_size'))) ? ' checked' : '' }} type="checkbox" value="1">
                                               Auto
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="transmission[is_manual]" {{ (is_array(old('transmission')) && in_array(1, old('car_size'))) ? ' checked' : '' }} type="checkbox" value="1">
                                               Manual
                                    </label>
                                </div>
                                <small class="text-danger">{{ $errors->first('transmission') }}</small>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('bootstrap_startup/images/car_size.png') }}" width="350" class="img-responsive"/>
                            </div>
                            <div class="col-md-6">
                                <img src="{{ asset('bootstrap_startup/images/transmission.png') }}" width="100" class="img-responsive mt-3"/>
                            </div>
                        </div>

                    </div>
                    <div class="offset-md-4 col-md-4 offset-lg-4 col-lg-4 offset-sm-4 col-sm-4  mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
            @endif


            @if($profile->profile_status == '6') 
            <h3 class="green-color">Profile</b></h4>                 
            <p class="text-dark mt-5">Please take a picture of you or choose from gallery</p>

            <form method="post" action="{{ route('driverinfo.store_profile_photo') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <center>                                    
                                    <img src="{{ asset('bootstrap_startup/images/contact-icon.png') }}" id="profie_photo" width="200" class="img-responsive rounded-circle" />
                                   <!--<img src="data:image/jpeg;base64,{{ base64_encode($profile->profile_pic) }}" width="200" class="img-responsive rounded-circle" />-->
                                </center>
                            </div>
                            <div class="col-md-3">
                                <!--                                <div class="form-group">
                                                                    <input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>
                                                                </div>-->
                                <div class="form-group">
                                    <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                                        Upload Photo
                                        <input type="file" onchange="readURL(this, 'profie_photo');" name="profile_pic"/>
                                    </div>

                                    <center>
                                        <small class="text-danger">{{ $errors->first('profile_pic') }}</small>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-4 col-md-4 mt-5">
                        <div class="form-group">
                            <center>
                                <input type="submit" class="btn btn-greego1" value="NEXT" name="submit"/>
                            </center>
                        </div>
                    </div>
                </div>

            </form>
            @endif

            @if($profile->profile_status == '7') 
            <h3 class="green-color">Complete</b></h4>                 
            <p class="text-dark mt-3">Please wait for Greego check your background.</p>
            <div class="row">
                <div class="col-md-12">
                    <center>
                        <img src="{{ asset('bootstrap_startup/images/complete.png') }}" class="img-responsive mt-3" />
                    </center>
                </div>
                <div class="offset-4 col-md-4 mb-5 pt-2 mt-5">
                    <div class="form-group">
                        <center>
                            <a class="btn btn-greego1 text-white" href="{{ route('driverinfo.done') }}">Done</a>
                        </center>
                    </div>
                </div>
            </div>
            @endif


        </div>
    </div>
</div>


@endsection


@section('js')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDwtkU8jS65b7cxMzwWrYNzd2XFfgQ8Cgo&libraries=places" type="text/javascript"></script>
<script>
                                            $(document).ready(function () {
                                                var autocomplete;
                                                input = document.getElementById('state');
                                                autocomplete = new google.maps.places.Autocomplete(input, {
                                                });
                                                autocomplete.addListener('place_changed', function ()
                                                {
                                                    var place = autocomplete.getPlace();
                                                });
                                            });
                                            $(document).ready(function () {
                                                $('.home_insurance').hide();
                                                $('.current_driver').hide();
                                            });

                                            function show_div(div_class) {
                                                if (div_class == 'current_driver') {
                                                    $('.text_normal1').removeClass('text-success');
                                                    $('.text_normal1').addClass('text-success');
                                                } else {
                                                    $('.text_normal').removeClass('text-success');
                                                    $('.text_normal').addClass('text-success');
                                                }
                                                $('.' + div_class).toggle();
                                            }

                                            function readURL(input, img_id) {
                                                if (input.files && input.files[0]) {
                                                    $('#error_ext').hide();
                                                    $('#img_ext_error').html('');
                                                    var filename = input.files[0]['name'];
                                                    var extension = filename.replace(/^.*\./, '');
                                                    // Iff there is no dot anywhere in filename, we would have extension == filename,
                                                    // so we account for this possibility now
                                                    if (extension == filename) {
                                                        extension = '';
                                                    } else {
                                                        // if there is an extension, we convert to lower case
                                                        // (N.B. this conversion will not effect the value of the extension
                                                        // on the file upload.)
                                                        extension = extension.toLowerCase();
                                                    }
                                                    var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                                                    if ($.inArray(extension, fileExtension) == -1) {
                                                        $('#error_ext').show();
                                                        $('#img_ext_error').html("<b>Warning ! </b>Only formats are allowed : " + fileExtension.join(', '));
                                                        return false;
                                                    }

                                                    var reader = new FileReader();

                                                    reader.onload = function (e) {
                                                        $('#' + img_id)
                                                                .attr('src', e.target.result)
                                                                .width(150)
                                                                .height(200);
                                                    };

                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
</script>

<script>
    $("#social_security_number").inputmask({"mask": "999-99-9999"});
</script>

@endsection
