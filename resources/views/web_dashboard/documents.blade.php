@extends('layouts.web.dashboard')

@section('content')

<div class="row p-4 mt-2">
    <div class="col-md-12">
        <form method="post" action="{{ route('account.store_document') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row mt-5 text-dark">
                <div class="col-md-6">
                    <label><b>Upload a photo of your Driver's License</b></label><br/>
                    @if(isset($license))
                    <img src="{{ $license }}" id="driving_license" width="150" height="200" class="img-responsive img-fluid p-3" />
                    @else
                    <img src="{{ asset('bootstrap_startup/images/driving_license.png') }}" id="driving_license" class="img-responsive img-fluid" />
                    @endif
                </div>
                <div class="col-md-3 mt-md-5">
                    <div class="form-group mt-md-5">
                        <!--<input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>-->
                        <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                            Upload photo 
                            <input type="file"  onchange="readURL(this, 'driving_license');" name="driving_license"/>
                        </div>
                        <center>
                            <small class="text-danger">{{ $errors->first('driving_license') }}</small>
                        </center>
                    </div>
                </div>
                <div class="col-md-6">
                    <label><b>Upload a photo of your Auto Insurance Card</b></label><br/>
                    @if(isset($insurance))
                    <img src="{{ $insurance }}" width="150" height="200" id="insurance_card" class="img-responsive img-fluid p-3" />
                    @else                    
                    <img src="{{ asset('bootstrap_startup/images/insurance_card.png') }}" id="insurance_card" class="img-responsive img-fluid" />
                    @endif
                </div>

                <div class="col-md-3 mt-md-5">
                    <div class="form-group mt-md-5">
                        <!--<input type="button" class="btn btn-grey border-radius text-capitalize" value="Take Photo" name="take_photo"/>-->
                        <div class="file btn btn-primary border-radius full-width text-capitalize upload_file">
                            Upload photo 
                            <input type="file"  onchange="readURL(this, 'insurance_card');" name="insurance_card"/>
                        </div>
                        <center>
                            <small class="text-danger">{{ $errors->first('insurance_card') }}</small>
                        </center>
                    </div>
                </div>
            </div>

            <div class="offset-md-4 col-md-4">
                <div class="form-group mt-md-4">
                    <center>
                        <input type="submit" class="btn btn-greego1" value="Submit" name="submit"/>
                    </center>
                </div>
            </div>


        </form>
    </div>
</div>

@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('#driving_license').css('cursor', 'pointer');
        $('#insurance_card').css('cursor', 'pointer');
    });
    $('#driving_license').click(function () {
        $('input[name="driving_license"]').click();
    });
    $('#insurance_card').click(function () {
        $('input[name="insurance_card"]').click();
    });
    function readURL(input, img_id) {
        if (input.files && input.files[0]) {
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

@endsection
