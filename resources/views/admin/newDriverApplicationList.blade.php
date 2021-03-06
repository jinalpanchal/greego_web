@extends('layouts.admin')

@section('content')           
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                New Drivers Application           
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Driver Management</a></li>
                <li class="active">New Drivers Application</li>            
            </ol> 
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- date Filter-->
            <div class="row">
                <div class="col-xs-12">
                    <form class="filter-driver-form" method='post' action="">
                      {{csrf_field()}}
                    <div class="row">
                        <div class="col-xs-2">
                            <label>Select Date:</label>
                        </div>
                        <div class="col-xs-6">                                                            
                            <div class="form-group">
<!--                                    <label>Date range:</label>-->
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text"  name='driverdate' class="form-control pull-right" id="reservation">
                                </div>
                            </div>                            
                        </div>
                        <div class="col-xs-4">
                            <div class="row">
                                <div class="col-xs-4">
                                    <button type="button" id="driver_filter_btn" class="btn btn-primary btn-block btn-flat">Search</button>
                                </div>
                                <div class="col-xs-4">
                                    <a href="{{ route('admin.driver.index')}}" id="filter_driver_reset" class="btn btn-primary btn-block btn-flat">Reset</a>
                                </div>
                            </div>                                                        
                        </div>                        
                    </div>
                </form>                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <!--<h3 class="box-title">Hover Data Table</h3>-->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="driverdatatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Contact Number</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email Address</th>                                        
                                        <th>Verified</th>
                                        <th>Registered On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
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
<!-- ajax call to get user data from table -->
@endsection
@section('custom_js')           
<script>
$(document).ready(function() {
    $(function() {
        $('#reservation').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('#reservation').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
        });

        $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });
    
    var driverdatatable = $('#driverdatatable').DataTable({ 
            "processing": true,
            "ajax": "{{ route('admin.newdriver.ajax.newdriverarray') }}"
        });
    $("body").on("click", "#driver_filter_btn", function () {
        var driverdates = $("#reservation").val();
        $.ajax({
            url: "{{ route('admin.newdriver.ajax.newdriverarray') }}",
            type: 'get',
            data: {
                driverdates: driverdates,
            }
        }).done(function (result) {
            driverdatatable.clear().draw();
            result = $.parseJSON(result);
            var rowNode = driverdatatable.rows.add(result.data).draw().nodes();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            // needs to implement if it fails
        });
    });// end of btn filter
} );// end of document ready 
</script>
@endsection