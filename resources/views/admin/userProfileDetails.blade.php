@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User Profile Details        
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">User Profile Details</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class='row' id='pro_desc'>
        <!-- profile left -->
        <div class='col-sm-3'>
            <div class="box box-primary">
                <div class="box-body box-profile">                    
                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/default_avatar.png" alt="User profile picture">
                    <h3 class="profile-username text-center">{{  $userdatas->name.' '.$userdatas->lastname }}</h3>
                    <p class="text-muted text-center"></p>
                    <ul class="list-group list-group-unbordered">                       
                        <li class="list-group-item">
                            <b>Contact Number</b> <a class="pull-right">{{  $userdatas->contact_number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>City</b> <a class="pull-right">{{  ($userdatas->city == null)? '-': $userdatas->city }}</a>
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
                    <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Card Details</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Vehical Details</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th style="width:30%;">Promo code</th>
                                    <td>{{  ($userdatas->promocode == null)? '-' : $userdatas->promocode }}</td>
                                </tr>

                                <tr>
                                    <th>OTP Verification Status</th>
                                    <td>{{  ($userdatas->verified == 1)? 'Verified' : 'Not Verified' }}</td>
                                </tr>
                                <tr>
                                    <th>Registered On</th>
                                    <td>{{  ($userdatas->created_at != null)? $userdatas->created_at : '-' }}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                    <!--tab 2-->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        @if(count($usercards) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Card Number</th>
                                    <th>Card Expire On</th>                                    
                                    <th>zip code</th>
                                </tr>
                            </thead>
                            <tbody>                                                                
                                @php
                                $id = 1
                                @endphp
                                @foreach($usercards as $usercard)                                
                                <tr>
                                    <td>{{ ($usercard->id != null)? $id : '-' }}</td>
                                    <td>{{ (base64_decode($usercard->card_number) != null)? base64_decode($usercard->card_number) : '-' }}</td>
                                    <td>{{ ($usercard->exp_month_year != null)? $usercard->exp_month_year : '-' }}</td>                                    
                                    <td>{{ ($usercard->zipcode != null)? $usercard->zipcode : '-' }}</td>                                    
                                </tr>
                                @php
                                $id++
                                @endphp
                                @endforeach                                
                            </tbody>
                        </table>
                        @else
                        <label style="padding:5% 0">{{ 'Data not avilable.' }}</label>
                        @endif
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <!-- Tab3 -->
                        @if(count($vehicles) > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Vehicle</th>
                                    <th>Manufacturer</th>                                    
                                    <th>Year</th>
                                    <th>color</th>
                                </tr>
                            </thead>
                            <tbody>                                                   
                                @foreach($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->id }}</td>
                                    <td>{{ $vehicle->vehiclemodel->model }}</td>
                                    <td>{{ $vehicle->vehiclemodel->vmake->name }}</td>
                                    <td>{{ $vehicle->year }}</td>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>                                
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <label style="padding:5% 0">{{ 'Data not avilable.' }}</label>
                        @endif
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>

</section>
<!-- end of Main content -->
@endsection

