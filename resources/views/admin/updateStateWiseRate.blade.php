@extends('layouts.admin')

@section('content')           
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Update Rate</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Rates</a></li>
        <li class="active">Update Rate</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">    
    <div class="row">
        <div class="col-xs-12">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)                   
                    <span style='color:red'>{{ $error }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Regionwise Rates</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <!-- Error message -->
                @if( session('success') )
                    <div class="alert alert-success alert-dismissable fade in alert_msg">            
                        <span style='color:white'>{{ session('success') }}</span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                @endif
                <form class="form-horizontal" action="{{ route('admin.rates.update',$edit_rate->id)}}" method="post">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}                                        
                    <div class="box-body">
                        <input type="hidden" class="form-control" value='{{ $edit_rate->usa_state_id }}' name='usa_state_id' id="usa_state_id" >
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">State</label>
                            <div class="col-sm-4">                            
                                <select class="form-control" name='usa_state_id' disabled>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ ($edit_rate->usa_state_id == $state->id) ? 'selected' : '' }} >{{ $state->abbreviation }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Base rate</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value='{{ ($edit_rate->base_fee != '') ? $edit_rate->base_fee : '' }}' name='base_fee' id="baserate" placeholder="Base rate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Time</label>
                            <div class="col-sm-4">
                                <input type="text" value='{{ ($edit_rate->time_fee != '') ? $edit_rate->time_fee : '' }}' class="form-control" name='time_fee' id="time" placeholder="Time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Rate Per Mile</label>
                            <div class="col-sm-4">
                                <input type="text" value='{{ ($edit_rate->mile_fee != '') ? $edit_rate->mile_fee : '' }}' class="form-control" name='mile_fee' id="ratepermile" placeholder="Rate Per Mile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Cancellation Rate</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value='{{ ($edit_rate->cancel_fee != '') ? $edit_rate->cancel_fee : '' }}' name='cancel_fee' id="cancellationrate" placeholder="Cancellation Rate">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Over Time Rate</label>
                            <div class="col-sm-4">
                                <input type="text" value='{{ ($edit_rate->overmile_fee != '') ? $edit_rate->overmile_fee : '' }}' class="form-control" name='overmile_fee' id="overtimerate" placeholder="Over Time Rate">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Rate Status {{$edit_rate->is_approve}}</label>
                            <div class="col-sm-8">
                                <label class="radio-inline">
                                    <input type="radio" name="is_active" value="1" {{($edit_rate->is_active == 1) ? 'checked' : ''}}>Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="is_active" value="0" {{($edit_rate->is_active == 0) ? 'checked' : ''}}>In Active
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" value='submit' name='submit' id='rate' class="btn btn-info pull-right">Submit</button>
                        </div>
                        <div class="col-sm-4">
                            <a href='{{ route('admin.rates.index')}}' class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                    <!-- /.box-body -->                    
                </form>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
<!-- ajax call to get user data from table -->
@endsection