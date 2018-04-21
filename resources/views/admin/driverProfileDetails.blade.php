@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Driver</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>        
        <li class="active">Driver</li>
        <li class="active">Driver Profile Details</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class='row' id='pro_desc'>
        <!-- profile left -->
        <div class='col-sm-3'>
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/default_avatar.png" alt="Driver profile picture">

                    <h3 class="profile-username text-center">{{  $driverdatas->name.' '.$driverdatas->lastname }}</h3>

                    <p class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>DOB</b> <a class="pull-right">{{  ($driverdatas->dob != null) ? date('m-d-Y',strtotime($driverdatas->dob)) : '-'  }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Contact Number</b> <a class="pull-right">{{  ($driverdatas->contact_number != null) ? $driverdatas->contact_number : '-'  }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>City</b> <a class="pull-right">{{  ($driverdatas->city == null || $driverdatas->city == '')? '-' : $driverdatas->city }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Driver Status</b> 
                            <a class="pull-right">
                                @if ($driverdatas->current_status == 0)
                                {{ 'Off Trip'  }}
                                @elseif ($driverdatas->current_status == 1)
                                {{ 'On Trip' }}
                                @elseif ($driverdatas->current_status == 2)
                                {{ 'Available' }}
                                @else
                                {{ '-' }}
                                @endif
                            </a>
                        </li>
                    </ul>                    
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- profile Right -->
        <div class='col-sm-9'>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Details</a></li>
                    <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Bank Information</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Trip Details</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <table class="table table-striped">
                            <tbody>                                
                                <tr>
                                    <th style="width:30%;">Legal First Name</th>
                                    <td>{{ ($driverdatas->legel_firstname != null)? $driverdatas->legel_firstname : '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Legal Middle Name</th>
                                    <td>{{ ($driverdatas->legel_middlename != null)? $driverdatas->legel_middlename : '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Legal Last Name</th>
                                    <td>{{ ($driverdatas->legel_lastname != null)? $driverdatas->legel_lastname  : '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Social Security Number </th>
                                    <td>{{ ($driverdatas->social_security_number != null)? $driverdatas->social_security_number : '-' }}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Driver can Transmit </th>
                                    <td>
                                        @if ($driverdatas->is_auto == 1 && $driverdatas->is_manual == 0)
                                        {{ 'Automatic vehicle'  }}
                                        @elseif ($driverdatas->is_auto == 0 && $driverdatas->is_manual == 1)
                                        {{ 'Manual vehicle' }}
                                        @elseif ($driverdatas->is_auto == 1 && $driverdatas->is_manual == 1)
                                        {{ 'Both Automatic and Manual vehicles' }}
                                        @else
                                        {{ '-' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Can Drive</th>
                                    <td>
                                        {{ ( ($driverdatas->is_sedan != null) && ($driverdatas->is_sedan == 1) )? 'Sedan' : ' ' }}
                                        {{ ( ($driverdatas->is_suv != null) && ($driverdatas->is_suv == 1) )? ' SUV' : ' ' }}
                                        {{ ( ($driverdatas->is_van != null) && ($driverdatas->is_van == 1) )? ' Van' : '' }}
                                        {{ ( ($driverdatas->is_sedan == 0) && ($driverdatas->is_suv == 0) && ($driverdatas->is_van == 0) )? ' -' : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Driver Current Status</th>
                                    <td>
                                        @if ($driverdatas->current_status == 0)
                                        {{ 'Off Trip'  }}
                                        @elseif ($driverdatas->current_status == 1)
                                        {{ 'On Trip' }}
                                        @elseif ($driverdatas->current_status == 2)
                                        {{ 'Available' }}
                                        @else
                                        {{ '-' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Promo code</th>
                                    <td>{{  old('promocode') == null  ? "-" : $driverdatas->promocode }}</td>
                                </tr>                                
                                <tr>
                                    <th>Registered On</th>
                                    <td>{{  date('m-d-Y',strtotime($driverdatas->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <th>Last Deatail Update</th>
                                    <td>{{  old('updated_at') == null  ? "-" : date('m-d-Y',strtotime($driverdatas->updated_at))  }}</td>
                                </tr>                                                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <!--tab 2-->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->                        
                        <table class="table table-striped">
                            <tbody>                                
                                <tr>
                                    <th style="width:30%;">Routing Number  </th>
                                    <td>{{  $driverdatas->routing_number == null  ? "-" : $driverdatas->routing_number }}</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Account Number</th>
                                    <td>{{  $driverdatas->routing_number == null  ? "-" : $driverdatas->account_number }}</td>
                                </tr>                                                                                              
                            </tbody>
                        </table>
                        
                        <!--                        <ul class="timeline timeline-inverse">
                                                     timeline time label 
                                                    <li class="time-label">
                                                        <span class="bg-red">
                                                            10 Feb. 2014
                                                        </span>
                                                    </li>
                                                     /.timeline-label 
                                                     timeline item 
                                                    <li>
                                                        <i class="fa fa-envelope bg-blue"></i>
                        
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                        
                                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                        
                                                            <div class="timeline-body">
                                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                                quora plaxo ideeli hulu weebly balihoo...
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-primary btn-xs">Read more</a>
                                                                <a class="btn btn-danger btn-xs">Delete</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                     END timeline item 
                                                     timeline item 
                                                    <li>
                                                        <i class="fa fa-user bg-aqua"></i>
                        
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                        
                                                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                                            </h3>
                                                        </div>
                                                    </li>
                                                     END timeline item 
                                                     timeline item 
                                                    <li>
                                                        <i class="fa fa-comments bg-yellow"></i>
                        
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                        
                                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                        
                                                            <div class="timeline-body">
                                                                Take me to your leader!
                                                                Switzerland is small and neutral!
                                                                We are more like Germany, ambitious and misunderstood!
                                                            </div>
                                                            <div class="timeline-footer">
                                                                <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                     END timeline item 
                                                     timeline time label 
                                                    <li class="time-label">
                                                        <span class="bg-green">
                                                            3 Jan. 2014
                                                        </span>
                                                    </li>
                                                     /.timeline-label 
                                                     timeline item 
                                                    <li>
                                                        <i class="fa fa-camera bg-purple"></i>
                        
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                        
                                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                        
                                                            <div class="timeline-body">
                                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                                <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                            </div>
                                                        </div>
                                                    </li>
                                                     END timeline item 
                                                    <li>
                                                        <i class="fa fa-clock-o bg-gray"></i>
                                                    </li>
                                                </ul>-->
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <!-- Tab3 -->
                        <h5>Data Not Available.</h5>
                        <!--                        <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        
                                                        <div class="col-sm-10">
                                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputName" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                        
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                        
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" class="btn btn-danger">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>-->
                    </div>
                    <!-- /.tab-pane -->
                </div>  
                <!-- /.tab-content -->
            </div>
        </div>
        <div class='col-sm-offset-3 col-sm-9'>
<!--            <div class='row'>
                <div class='col-sm-3 drivmargin'>
                    <span><b>Driver Application Status:</b></span>
                </div>
                <div class='col-sm-6'>
                    <div class="form-group">
                        <div class='row'>
                            <div class='col-sm-3'>
                                <input type="hidden" id="driver_status" value="{{ $driverdatas->is_approve }}">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class='status' name="driver_status" id="approve_driver" value="{{ 'a_'.$driverdatas->id }}">
                                        Approve
                                    </label>
                                </div>
                            </div>
                            <div class='col-sm-3'>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class='status' name="driver_status" id="reject_driver" value="{{ 'r_'.$driverdatas->id }}">
                                        Reject
                                    </label>
                                </div>
                            </div>
                            <div class='col-sm-6'></div>
                        </div>                                                                    
                    </div>
                </div>

                <div class='col-sm-3'>
                    <input type="hidden" id="driver_id" value="{{ $driverdatas->id }}">                    
                    <button type="button" id='approve_status' class="{{ ($driverdatas->is_approve == 1 ) ? 'btn btn-block btn-success' : 'btn btn-block btn-danger' }}" value="{{ ($driverdatas->is_approve == 1 ) ? 0 : 1 }}">{{ ($driverdatas->is_approve == 1 ) ? "Approved" : "Reject" }}</button>
                </div>
            </div>            -->
        </div>
    </div>

</section>
<!-- end of Main content -->
@endsection
@section('custom_js')           
<script>
    $(document).ready(function () {
        $("body").on("click", ".status", function () {
            var driver_id = $(this).val();
            var status = $("#driver_status").val();
            $.ajax({
                url: "ajax/update_status",
                type: 'get',
                data: {
                    id: driver_id,
                    status: status
                },
                success: function (responce) {
//                    alert(responce)
                    if(responce == 1){
                        $('#driver_status_list').html('Approved');
                    }else if(responce == 2){
                        $('#driver_status_list').html('Rejected');
                    }                                        
                }
            });
        });
        /*
        $("body").on("click", "#approve_status", function () {
            var driverid = $("#driver_id").val();
            var status = $(this).val();
                        
            $.ajax({
                url: "ajax/update_status",
                type: 'get',
                data: {
                    id: driverid,
                    status: status
                },
                success: function (responce) {
                    if (responce == 'success') {
                        $("#approve_status").val((status > 0) ? 0 : 1);
                        $("#approve_status").html((status > 0) ? "Approved" : "Reject");
                        if (status > 0) {
                            $("#approve_status").removeClass("btn-danger");
                            $("#approve_status").addClass("btn-success");
                            $("#driver_status").html("Approved");
                        } else {
                            $("#approve_status").removeClass("btn-success");
                            $("#approve_status").addClass("btn-danger");
                            $("#driver_status").html("Rejected");
                        }

                    }
                }
            });
        });*/
    });// end of document ready 
</script>
@endsection

