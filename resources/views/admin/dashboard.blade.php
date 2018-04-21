@extends('layouts.admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
<!--        <small>Control panel</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->    
    <!-- row 1-->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box boxheight">
                <span class="info-box-icon pt-6 bg-red boxheighticon"><i class="fa fa-send"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Requests </span>
                    <span class="info-box-number">500</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box boxheight">
                <span class="info-box-icon pt-6 bg-yellow boxheighticon"><i class="fa fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Completed Req</span>
                    <span class="info-box-number">301</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box boxheight">
                <span class="info-box-icon pt-6 bg-blue boxheighticon"><i class="fa fa-spinner"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ongoing Req</span>
                    <span class="info-box-number">100</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box boxheight">
                <span class="info-box-icon pt-6 bg-green boxheighticon"><i class="fa fa-ban"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cancelled Req</span>
                    <span class="info-box-number">99</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
    <!-- row 2-->
    <div class="row">
        <!-- Total Amount -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>$1500.00</h3>
                    <p>Total</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <!-- <a target="_blank" href="http://nikola.world/admin/users" class="small-box-footer"> -->

<!-- <i class="fa fa-arrow-circle-right"></i> -->

            </div>
        </div>        
    </div>
    <!-- Row 3 --->
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ongoing Trips</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">                               
                                <thead>
                                    <tr>
                                        <th>Ref No</th>
                                        <th>User</th>
                                        <th>Driver</th>
                                        <th>Source</th>
                                        <th>Destination</th>
                                        <th>Est. Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Allan</td>
                                        <td>Smith</td>
                                        <td>New York</td>
                                        <td>Washington</td>                                    
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Piter</td>
                                        <td>Mark</td>
                                        <td>Ohio</td>
                                        <td>chicago</td>
                                        <td>$200</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas   </td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas   </td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas   </td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas   </td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas</td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td>Robert</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas</td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>9.</td>
                                        <td>Robin</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas   </td>
                                        <td>$100</td>
                                    </tr>
                                    <tr>
                                        <td>10.</td>
                                        <td>Robin</td>
                                        <td>Michael</td>
                                        <td>South Dakota</td>
                                        <td>Texas</td>
                                        <td>$100</td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <!--                    <div class="box-footer clearfix">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                        </div>-->
                    <!-- /.box-footer -->
                </div>  
            <!-- /.box -->
        </div>

        <div class="col-md-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registered Users</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <input type="hidden" name='android_user_count' id='android_user_count' value="{{ $android_user }}">
                        <input type="hidden" name='iphone_user_count' id='iphone_user_count' value="{{ $iphone_user }}">
                        <div class="col-md-12">
                            <p class="text-center">
                                <strong></strong>
                            </p>

                            <div class="chart-responsive">
                                <canvas id="registerChart" height="200" width="321" style="width: 321px; height: 200px;"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <!--                        <li>
                                                    <a href="#">
                                                        <strong class="text-red">Total Web Users</strong>
                                                        <span class="pull-right text-red">
                                                            <i class="fa fa-angle-right"></i> 3
                                                        </span>
                                                    </a>
                                                </li>-->

                        <li>
                            <a href="#">
                                <strong class="text-green">Total Android Users </strong>
                                <span class="pull-right text-green">
                                    <i class="fa fa-angle-right"></i> {{ $android_user }}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <strong class="text-yellow">Total iOS Users</strong>
                                <span class="pull-right text-yellow">
                                    <i class="fa fa-angle-right"></i> {{ $iphone_user }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- row 4 -->
        <div class='row' style='margin-left: 4px;'>
            
            <div class='col-sm-8'>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest User</h3>

                        <div class="box-tools pull-right">
                            <span class="label label-danger">8 New Members</span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <li>
                                <img src="dist/img/user1-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander Pierce</a>
                                <span class="users-list-date">Today</span>
                            </li>
                            <li>
                                <img src="dist/img/user8-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Norman</a>
                                <span class="users-list-date">Yesterday</span>
                            </li>
                            <li>
                                <img src="dist/img/user7-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Jane</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="dist/img/user6-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">John</a>
                                <span class="users-list-date">12 Jan</span>
                            </li>
                            <li>
                                <img src="dist/img/user2-160x160.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Alexander</a>
                                <span class="users-list-date">13 Jan</span>
                            </li>
                            <li>
                                <img src="dist/img/user5-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Sarah</a>
                                <span class="users-list-date">14 Jan</span>
                            </li>
                            <li>
                                <img src="dist/img/user4-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nora</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                            <li>
                                <img src="dist/img/user3-128x128.jpg" alt="User Image">
                                <a class="users-list-name" href="#">Nadia</a>
                                <span class="users-list-date">15 Jan</span>
                            </li>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{ url('admin/user') }}" class="uppercase">View All Users</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
            <div class='col-sm-4'>
                
            </div>
        </div>
        <!-- row old -->
        <!--<div class="row">-->
        <!-- dashboard box 1-->
        <!--<div class="col-lg-3 col-xs-6">-->
        <!--small box--> 
        <!--            <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $user_count }}</h3>
                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.user.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>        
                <div class="col-lg-3 col-xs-6">-->
        <!-- small box -->
        <!--            <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $driver_count }}</h3>
                            <p>Active Driver</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.driver.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>        
            </div>-->
        <!-- /.row -->
        <!-- user -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <!--<div class="nav-tabs-custom">-->
                <!-- Tabs within a box -->
                <!--                <ul class="nav nav-tabs pull-right">
                                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                                </ul>
                                <div class="tab-content no-padding">
                                     Morris chart - Sales 
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div>
                             /.nav-tabs-custom -->
                <!-- Chat box -->
                <!--            <div class="box box-success">
                                <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                
                                    <h3 class="box-title">Chat</h3>
                
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                                        <div class="btn-group" data-toggle="btn-toggle">
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                                            </button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body chat" id="chat-box">
                                     chat item 
                                    <div class="item">
                                        <img src="dist/img/user4-128x128.jpg" alt="user image" class="online">
                
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                Mike Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                        <div class="attachment">
                                            <h4>Attachments:</h4>
                
                                            <p class="filename">
                                                Theme-thumbnail-image.jpg
                                            </p>
                
                                            <div class="pull-right">
                                                <button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
                                            </div>
                                        </div>
                                         /.attachment 
                                    </div>
                                     /.item 
                                     chat item 
                                    <div class="item">
                                        <img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">
                
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>                                
                                                Alexander Pierce
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                     /.item 
                                     chat item 
                                    <div class="item">
                                        <img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">
                
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                                                Susan Doe
                                            </a>
                                            I would like to meet you to discuss the latest news about
                                            the arrival of the new theme. They say it is going to be one the
                                            best themes on the market
                                        </p>
                                    </div>
                                     /.item 
                                </div>
                                 /.chat 
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Type message...">
                
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                <!-- /.box (chat box) -->
                <!-- TO DO List -->
                <!--            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                
                                    <h3 class="box-title">To Do List</h3>
                
                                    <div class="box-tools pull-right">
                                        <ul class="pagination pagination-sm inline">
                                            <li><a href="#">&laquo;</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">&raquo;</a></li>
                                        </ul>
                                    </div>
                                </div>
                                 /.box-header 
                                <div class="box-body">
                                     See dist/js/pages/dashboard.js to activate the todoList plugin 
                                    <ul class="todo-list">
                                        <li>
                                             drag handle 
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                             checkbox 
                                            <input type="checkbox" value="">
                                             todo text 
                                            <span class="text">Design a nice theme</span>
                                             Emphasis label 
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                             General tools such as edit or delete
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="">
                                            <span class="text">Make the theme responsive</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="">
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="">
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="">
                                            <span class="text">Check your messages and notifications</span>
                                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="">
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                 /.box-body 
                                <div class="box-footer clearfix no-border">
                                    <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                                </div>
                            </div>-->
                <!-- /.box -->
                <!-- quick email widget -->
                <!--            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                
                                    <h3 class="box-title">Quick Email</h3>
                                     tools box 
                                    <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                                title="Remove">
                                            <i class="fa fa-times"></i></button>
                                    </div>
                                     /. tools 
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject">
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message"
                                                      style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                        <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>-->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
                <!-- Map box -->
                <!--            <div class="box box-solid bg-light-blue-gradient">
                                <div class="box-header">
                                     tools box 
                                    <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                                                title="Date range">
                                            <i class="fa fa-calendar"></i></button>
                                        <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                                                data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                                            <i class="fa fa-minus"></i></button>
                                    </div>
                                     /. tools 
                
                                    <i class="fa fa-map-marker"></i>
                
                                    <h3 class="box-title">
                                        Visitors
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div id="world-map" style="height: 250px; width: 100%;"></div>
                                </div>
                                 /.box-body
                                <div class="box-footer no-border">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <div id="sparkline-1"></div>
                                            <div class="knob-label">Visitors</div>
                                        </div>
                                         ./col 
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <div id="sparkline-2"></div>
                                            <div class="knob-label">Online</div>
                                        </div>
                                         ./col 
                                        <div class="col-xs-4 text-center">
                                            <div id="sparkline-3"></div>
                                            <div class="knob-label">Exists</div>
                                        </div>
                                         ./col 
                                    </div>
                                     /.row 
                                </div>
                            </div>-->
                <!-- /.box -->
                <!-- solid sales graph -->
                <!--            <div class="box box-solid bg-teal-gradient">
                                <div class="box-header">
                                    <i class="fa fa-th"></i>
                
                                    <h3 class="box-title">Sales Graph</h3>
                
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body border-radius-none">
                                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                                </div>
                                 /.box-body 
                                <div class="box-footer no-border">
                                    <div class="row">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">
                
                                            <div class="knob-label">Mail-Orders</div>
                                        </div>
                                         ./col 
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                            <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">
                
                                            <div class="knob-label">Online</div>
                                        </div>
                                         ./col 
                                        <div class="col-xs-4 text-center">
                                            <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                                   data-fgColor="#39CCCC">
                
                                            <div class="knob-label">In-Store</div>
                                        </div>
                                         ./col 
                                    </div>
                                     /.row 
                                </div>
                                 /.box-footer 
                            </div>-->
                <!-- /.box -->
                <!-- Calendar -->
                <!--            <div class="box box-solid bg-green-gradient">
                                <div class="box-header">
                                    <i class="fa fa-calendar"></i>
                
                                    <h3 class="box-title">Calendar</h3>
                                     tools box 
                                    <div class="pull-right box-tools">
                                         button with a dropdown 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-bars"></i></button>
                                            <ul class="dropdown-menu pull-right" role="menu">
                                                <li><a href="#">Add new event</a></li>
                                                <li><a href="#">Clear events</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">View calendar</a></li>
                                            </ul>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                     /. tools 
                                </div>
                                 /.box-header 
                                <div class="box-body no-padding">
                                    The calendar 
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                                 /.box-body 
                                <div class="box-footer text-black">
                                    <div class="row">
                                        <div class="col-sm-6">
                                             Progress bars 
                                            <div class="clearfix">
                                                <span class="pull-left">Task #1</span>
                                                <small class="pull-right">90%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                                            </div>
                
                                            <div class="clearfix">
                                                <span class="pull-left">Task #2</span>
                                                <small class="pull-right">70%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                                            </div>
                                        </div>
                                         /.col 
                                        <div class="col-sm-6">
                                            <div class="clearfix">
                                                <span class="pull-left">Task #3</span>
                                                <small class="pull-right">60%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                                            </div>
                
                                            <div class="clearfix">
                                                <span class="pull-left">Task #4</span>
                                                <small class="pull-right">40%</small>
                                            </div>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                                            </div>
                                        </div>
                                         /.col 
                                    </div>
                                     /.row 
                                </div>
                            </div>-->
                <!-- /.box -->
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
</section>
@endsection

@section('custom_js')           
<script>
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var android_cnt = document.getElementById("android_user_count").value;        
    var iphone_cnt = document.getElementById("iphone_user_count").value;    
    var pieChartCanvas = $("#registerChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
//        {
//            value: 3,
//            color: "#f56954",
//            highlight: "#f56954",
//            label: "Web"
//        },
        {
            value: android_cnt,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Andorid"
        },
        {
            value: iphone_cnt,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "iOS"
        }
    ];
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        //String - A tooltip template
        tooltipTemplate: "<%=value %> <%=label%> users"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    //-----------------
    //- END PIE CHART -
    //-----------------
</script>
@endsection