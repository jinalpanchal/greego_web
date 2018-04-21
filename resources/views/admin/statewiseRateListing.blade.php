@extends('layouts.admin')

@section('content')           
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>USA State Wise Rate List</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Rates</a></li>
                <li class="active">USA State Wise Rate List</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- error message -->
            @if( session('error') )
                <div class="alert alert-danger alert-dismissable fade in alert_msg">            
                    <span style='color:white'>{{ session('error') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @elseif( session('Error') )
                <div class="alert alert-danger alert-dismissable fade in alert_msg">
                    <span style='color:white'>{{ session('Error') }}</span>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <!--<h3 class="box-title">Hover Data Table</h3>-->
                        </div>
                        <!-- /.box-header -->                                                 
                        <div class="box-body">
                            <table id="usaRateTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>State</th>
                                        <th>Base Fee</th>
                                        <th>Time Fee</th>
                                        <th>Mile Fee</th>
                                        <th>Cancel Fee</th>
                                        <th>Over Mile Fee</th>
                                        <th>Change Rate Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($allRates as $allRate)
                                    <tr>
                                        <td>{{ $allRate->state->state_name }}</td>                                    
                                        <td>{{ $allRate->base_fee }}</td>                                                                        
                                        <td>{{ $allRate->time_fee }}</td>                                    
                                        <td>{{ $allRate->mile_fee }}</td>                                    
                                        <td>{{ $allRate->cancel_fee }}</td>                                    
                                        <td>{{ $allRate->overmile_fee }}</td>                                       
                                        <td>
                                            {{ $allRate->is_active == 1 ? 'Active' : 'In Active' }}                                            
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.rates.edit',$allRate->id) }}" class="btn btn-info btn-xs"><i class='fa fa-fw fa-pencil-square-o' aria-hidden='true'></i></a>                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>                                
                            </table>
                        </div>                        
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->    
    <!-- /.content-wrapper -->
@endsection
@section('custom_js')           
<script>
$(document).ready(function() {        
        var driverdatatable = $('#usaRateTable').DataTable({});
} );// end of document ready 
</script>
@endsection