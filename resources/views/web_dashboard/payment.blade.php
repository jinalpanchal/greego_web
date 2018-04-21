@extends('layouts.web.dashboard')

@section('content')
<div class="container pb-5">
<div class="row p-4 mt-2 pb-5" id="payment">
    <div class="offset-md-3 col-md-6 pt-5 pb-3">
        <h6 class="head-title">Bank Info</h6>
        <div class="form-group no-border p-3 pb-0"> 
            <h6><img src="{{ asset('bootstrap_startup/images/bank-2.png') }}" class="img-responsive img-fluid" width="35"/>
                <b>&nbsp;&nbsp;Bank Info</b>
            </h6>
        </div>
    </div>

    <div class="offset-md-3 col-md-6 pt-2">
        <div class="form-group border-grey"></div>            
    </div>
    <div class="offset-md-3 col-md-6 pt-2 pb-5 mb-5">
        <h6 class="head-title">Express Pay</h6>
        <div class="form-group no-border p-3 pb-0"> 
            <h6><img src="{{ asset('bootstrap_startup/images/visa.png') }}" class="img-responsive img-fluid" width="35"/>                
            </h6>
        </div>
    </div>
</div>

<div class="row p-4 mt-2" id="bank_info">
    <div class="offset-md-1 col-md-10">
        <center><img src="{{ asset('bootstrap_startup/images/bank_check.png') }}" class="img-responsive img-fluid" width="150" height="80"/></center>

        <form method="post" action="{{ route('account.store_bank_info') }}">
            {{ csrf_field() }}

            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Accounting Number</label>
                        <input type="text" class="form-control" value="{{ base64_decode($driver_bank_info->account_number) }}" name="account_number" />
                        <small class="text-danger">{{ $errors->first('account_number') }}</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Routing Number</label>
                        <input type="text" class="form-control" value="{{ base64_decode($driver_bank_info->routing_number) }}"  name="routing_number" />
                        <small class="text-danger">{{ $errors->first('routing_number') }}</small>
                    </div>
                </div>


                <div class="offset-4 col-md-4 mt-5">
                    <div class="form-group">
                        <center>
                            <input type="submit" class="btn btn-greego1" value="Update" name="submit"/>
                        </center>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#bank_info').hide();
        $('#payment').on('click', function () {
            $('#payment').toggle();
            $('#bank_info').toggle();
        });
    });
</script>
@endsection

