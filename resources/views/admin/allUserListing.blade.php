@extends('layouts.admin')

@section('content')           
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Users List</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Users</li>
        <li class="active">Users List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">    
    <!-- date Filter-->
    <div class="row">
        <div class="col-xs-12">
            <form class="login-form" method='post' action="">
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
                                <input type="text" name='userdate' class="form-control pull-right" id="reservation">
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-4">
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="button" id="filter_btn" class="btn btn-primary btn-block btn-flat">Search</button>                            
                            </div>
                            <div class="col-xs-4">
                                <a href="{{ route('admin.user.index')}}" id="filter_reset" class="btn btn-primary btn-block btn-flat">Reset</a>
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
                    <table id="userdatatable" class="table table-bordered table-hover">
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
//    $('#userdatatable').DataTable( {
//        "ajax": "{{ route('admin.user.ajax.userarray') }}"
//    });
} );

    $(document).ready(function () {
        //Date range picker
//        $('#reservation').daterangepicker({
//            locale: {
//                format: 'YYYY/MM/DD'
//            }
//        });
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

        var userdatatable = $('#userdatatable').DataTable({ 
            "processing": true,
            "ajax": "{{ route('admin.user.ajax.userarray') }}"
        });
        $("body").on("click", "#filter_btn", function () {
            var userdates = $("#reservation").val();
            $.ajax({
                url: "{{ route('admin.user.ajax.userarray') }}",
                type: 'get',
                data: {
                    userdates: userdates,
                }
            }).done(function (result) {
                userdatatable.clear().draw();
                result = $.parseJSON(result);
                var rowNode = userdatatable.rows.add(result.data).draw().nodes();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                // needs to implement if it fails
            });
        });// end of data table
        
    });// end of document ready
</script>
@endsection